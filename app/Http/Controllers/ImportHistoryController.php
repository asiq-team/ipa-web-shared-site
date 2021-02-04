<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Cache;

use App\Models\ImportHistory;

use Yajra\DataTables\Facades\DataTables;

class ImportHistoryController extends Controller
{
    public function index(Request $request)
    {
        try {
            $client = new Client([
                'base_uri' => env('SERVER_AUTH',null),
                'timeout'  => 15.0
            ]);
            $ttl = 2 * 60;
            $token=$request->header("Authorization");
            $body = Cache::remember($token, $ttl, function () use ($client,$token) {
                $response = $client->request('GET', 'local/profile',[
                    'headers' => 
                        [
                            'Authorization' => $token
                        ]
                ]);

                return  (string)$response->getBody();
            });
          
            $data=array();
            if($body != null){
                $obj = json_decode($body);
                if($obj->data)
                    $data=$obj->data;
            }

            $import_list = ImportHistory::where('user_id',$data->id)
                            ->selectRaw("*")
                            ->orderby("created_at","desc")
                            ->get();

            return DataTables::collection($import_list)->toJson();
            
           // return response()->json($import_list);
        } catch (RequestException $e) {
            return response()->json(["status"=>$e->getMessage()]);
        } catch (ClientException $e) {
            return response()->json(["status"=>$e->getMessage()]);
        } catch (ConnectException $e){
            return response()->json(["status"=>$e->getMessage()]);
        } catch (\ErrorException $e){
            return response()->json(["status"=>$e->getMessage()]);
        }


        
    } 
}
