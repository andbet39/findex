<?php namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use Request;



class FileController extends BaseController
{

    public function saveFile()
    {
        $file = Request::file('file');
        Storage::disk('local')->put($file->getClientOriginalName(),  File::get($file));

        return response()->json('success');
    }

    public function deleteFile($name)
    {
        Storage::disk('local')->delete($name);
        return response()->json('success');
    }


    public function getFileList(){

        $files = Storage::disk('local')->files('/');
        return response()->json($files);

    }

    public function viewFile($name){

        return response()->make(Storage::disk('local')->get($name), 200, [
            'Content-Type' => Storage::disk('local')->mimeType($name),
            'Content-Disposition' => 'inline; '.$name,
        ]);

    }





    public function  search($term){

        $client = new \GuzzleHttp\Client();
        $res = $client->get('http://localhost:8983/solr/test/select?wt=json&rows=25&q='.$term);

        return  $res->getBody();
    }

    public function  reindex(){

        $client = new \GuzzleHttp\Client();
        $res = $client->get('http://localhost:8983/solr/test/dataimport?command=full-import&wt=json');

        return $res->getBody();
    }



}
