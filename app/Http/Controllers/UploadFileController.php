<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadFileController extends Controller
{
    public function upload_file(Request $request){
		$this->validate($request, [
			'file' => 'required',
		]);
 
		$file = $request->file('file');
        $folder_root = 'file_import';
        $targetDir = $folder_root;
        $direxist = Storage::exists($targetDir);
        if ($direxist) {
            Storage::makeDirectory($targetDir);
        }

        $ext = $file->getClientOriginalExtension();
        $real_name = Str::random(30).".".$ext;

        $request->session()->put('file_import_uploaded', $real_name);
 
        // upload file
        $upload_success = Storage::putFileAs($folder_root,$file,$real_name);
        
        if( $upload_success ) {
        	return response()->json($real_name, 200);
        } else {
        	return response()->json('error', 400);
        }
    }
}
