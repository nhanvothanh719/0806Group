<?php

namespace App\Http\Controllers;

use Illuminate\Request;
use ZipArchive;

class ZipController extends Controller
{
    public function zipFile()
    {
        $zip = new ZipArchive;
        $fileName = 'myzip.zip';
        if($zip->open(public_path($fileName),ZipArchive::CREATE)===true)
        {
            $file = File::files(public_path(''));
            foreach($file as $key => $value){
                $relativeNameInZipFile = basename ($value); 
                $zip->addFile($value,$relativeNameInZipFile);
            }
            $zip->close();
        }
        return response()->download(public_path($fileName));
    }
}
