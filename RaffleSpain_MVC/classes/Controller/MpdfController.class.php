<?php

require 'vendor/autoload.php';
use Mpdf\Mpdf;

class MpdfController extends Controller {
    
    public function show() {
        
        $html = '
            
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-4" />
            <title>Document in Lithuanian</title>
        </head>
        <body>
                    
        ... the body of the document encoded in ISO-8859-4 ...
                    
        </body>
        </html>';
        
        $mpdf = new Mpdf([
            'mode' => 'c',
            'format' => 'A4',
            'margin_right' => 10,
            'margin_top' => 10,
            'default_font_size' => '14',
            'default_font' => 'arial',
            'margin_footer' => 9,
            'orientation' => 'P',
            'margin_left' => 10,
            'margin_bottom' => 10,
            'margin_header' => 9,
            'allow_charset_conversion' => true,
            'charset_in' => 'utf-8'
        ]);
        
        $mpdf->WriteHTML($html);
        $mpdf->Output();
        
    }
    
}