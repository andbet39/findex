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

         $path = storage_path().DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.$name;


         return response()->make(file_get_contents($path), 200, [
            'Content-Type' => 'application/pdf',
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
