<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use App\Models\UserKey;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|string',
            'password' => 'required|string',
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate()
    {
        $this->ensureIsNotRateLimited();

        $credential=array(
            'username' => $this->email,
            'password' => $this->password,
            'deleted_at' => null
        );

        $credential_email=array(
            'email' => $this->email,
            'password' => $this->password,
            'deleted_at' => null
        );

     

        $usermodel = new UserKey;
        $appkey = $usermodel->getAppKey($this->email);
        if($appkey->application_key == $this->application_key){
            if (! Auth::attempt($credential, $this->filled('remember'))) {
                if (! Auth::attempt($credential_email, $this->filled('remember'))) {
                    RateLimiter::hit($this->throttleKey());
    
                    throw ValidationException::withMessages([
                        'email' => __('auth.failed'),
                    ]);
                }
            }
        } else {
            RateLimiter::hit($this->throttleKey());

                throw ValidationException::withMessages([
                    'email' => __("User tidak diperkenankan memakai aplikasi ini"),
                ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited()
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     *
     * @return string
     */
    public function throttleKey()
    {
        return Str::lower($this->input('email')).'|'.$this->ip();
    }
}
