<?php namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use Request;



class FileController extends BaseController
{

    public function postFile()
    {

        $file = Request::file('file');
        Storage::disk('local')->put($file->getClientOriginalName(),  File::get($file));

        return response()->json('success');
    }


    public function getFileList(){

        $files = Storage::files('/');
        return response()->json($files);

    }

    public function getFile($name){

        $file = Storage::get($name);
        $headers = array(
            'Content-Type' => $file->getMimeType()
        );
        return Response::download($file, $name , $headers);

    }


    public function  testguz(){

        $client = new \GuzzleHttp\Client();
        $res = $client->get('https://api.github.com/user', [
            'auth' =>  ['andrea.terzani@gmail.com', 'giada123']
        ]);
        echo $res->getStatusCode();           // 200
        echo $res->getHeader('content-type'); // 'application/json; charset=utf8'
        echo $res->getBody();                 // {"type":"User"...'
        return response()->$res;
    }


}
