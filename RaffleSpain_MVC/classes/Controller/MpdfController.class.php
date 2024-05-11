<?php

require 'vendor/autoload.php';
use Mpdf\Mpdf;

class MpdfController extends Controller {
    
    public function show($id) {
        
        $idValid = $this->sanitize($id[0]);
        
        if (!is_numeric($idValid)) {
            $errors = "El id pasado no es un id valido.";
        }
        
        if (!isset($errors)) {
            $mDeliver = new DeliverModel();
            $deliver = $mDeliver->getDeliver($idValid);
            
            $html = $this->generateTemplateDeliver($deliver[0]);
            
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
            
            $mpdf->SetProtection([
                'copy',
                'print'
            ], '', 'RafFleSpa1n2@24');
            $mpdf->showWatermarkText = true;
            $mpdf->watermark_font = 'Verdana';
            $mpdf->SetWatermarkText('RaffleSpain');
            
            $favicon = '<link rel="shortcut icon" type="image/x-icon" href="' . __DIR__ . '/../../public/img/favicon.ico">';
            $mpdf->SetHTMLHeader($favicon);
            
            $stylesheet = file_get_contents(__DIR__ . '/pdfStyles.css');
            $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
            $mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
            
            $mpdf->Output();
        } else {
            $cDeliver = new DeliverController();
            $cDeliver->showDelivers();
        }
    }
    
    public function generateTemplateDeliver($deliver) {
        $mClient = new ClientModel();
        var_dump($deliver);
        die;
        $client = $mClient->getById(new Client($deliver->client_id));
        
        return "<div class='pdf-wrap'>
                <table class='pdf-table'>
                    <thead>
                        <tr>
                            <th colspan='3' class='pdf-title'>Factura</th>
                            <th colspan='1'><img class='pdf-logo' src='" . __DIR__ . "/../../public/img/logo.png' alt='Logo Empresa'/></th>
                        </tr>
                    </thead>
                    <tr>
                        <th colspan='2' class='pdf-category'>ID de entrega</th>
                        <th class='pdf-category'>Fecha de entrega</th>
                        <th class='pdf-category'>Fecha de hora estimada</th>
                    </tr>
                    <tr>
                        <td colspan='2' class='pdf-data centrar-texto'>
                            <p>" . $deliver->id . "</p>
                        </td>
                        <td class='pdf-data centrar-texto'>
                            <p>" . $deliver->date_deliver . "</p>
                        </td>
                        <td class='pdf-data'>
                            <p>" . date('Y-m-d', strtotime($deliver->date_deliver . ' +5 days')) . "</p>
                        </td>
                    </tr>
                    <tr>
                        <th class='pdf-category'>Nombre Cliente</th>
                        <th class='pdf-category'>Apellido/s Cliente</th>
                        <th class='pdf-category'>Email</th>
                        <th class='pdf-category'>Telefono</th>
                    </tr>
                    <tr>
                        <td class='pdf-data centrar-texto'>
                            <p>" . $client->name . "</p>
                        </td>
                        <td class='pdf-data centrar-texto'>
                            <p>" . $client->surnames . "</p>
                        </td>
                        <td class='pdf-data centrar-texto'>
                            <p>" . $client->email . "</p>
                        </td>
                        <td class='pdf-data centrar-texto'>
                            <p>" . $client->phone . "</p>
                        </td>
                    </tr>
                    <tr>
                        <th colspan='2' class='pdf-category'>Direccion</th>
                        <th class='pdf-category'>Planta</th>
                        <th class='pdf-category'>Puerta</th>
                    </tr>
                    <tr>
                        <td colspan='2' class='pdf-data centrar-texto'>
                            <p>" . $client->address . ', ' . $client->postal_code . ', ' . $client->poblation . "</p>
                        </td>
                        <td class='pdf-data centrar-texto'>
                            <p>" . $client->floor . "</p>
                        </td>
                        <td class='pdf-data centrar-texto'>
                            <p>" . $client->door . "</p>
                        </td>
                    </tr>
                    <tr>
                        <th colspan='2' class='pdf-category'>Nombre Producto</th>
                        <th class='pdf-category'>Codigo Producto</th>
                        <th class='pdf-category'>Precio</th>
                    </tr>
                    <tr>
                        <td colspan='2' class='pdf-data centrar-texto'>
                            <p>" . $deliver->product->name . "</p>
                        </td>
                        <td class='pdf-data centrar-texto'>
                            <p>" . $deliver->product->modelCode . "</p>
                        </td>
                        <td class='pdf-data centrar-texto'>
                            <p>" . $deliver->product->price . "</p>
                        </td>
                    </tr>
                </table>
            </div>";
    }
    
}
