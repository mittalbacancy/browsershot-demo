<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\File;
use Spatie\Browsershot\Browsershot;


class TestPdfController extends BaseController
{    
    public function printPdf()
    {           
        $view =  view('welcome')->render();        

        $path = public_path("/pdf_temp/");
        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        Browsershot::url('https://google.com')
        ->format('A4')
        ->showBackground()
        ->save($path.'urlToPdf.pdf');

        echo 'Pdf generated at <i>public/urlToPdf.pdf</i>';


        Browsershot::html($view)->save($path.'htmlToPdf.pdf');
    }    
}