<?php

require 'vendor/autoload.php';
use Mpdf\Mpdf;

class MpdfController extends Controller {
    
    public function show($id) {
        
        $idValid = $this->sanitize($id[0]);
        
        if (!is_numeric($idValid)) {
            $errors = "El id pasado no es un id valido.";
        }
        
        $client = $_SESSION['usuari'];
        
        if ($client->address === null || $client->address === "") {
            $errors = 'El usuario tiene que tener el campo "direccion" asignado para generar la factura en PDF.';
        }
        
        if ($client->poblation === null || $client->poblation === "") {
            $errors = 'El usuario tiene que tener el campo "poblacion" asignado para generar la factura en PDF.';
        }
        
        if ($client->postal_code === null || $client->postal_code === "") {
            $errors = 'El usuario tiene que tener el campo "codigo postal" asignado para generar la factura en PDF.';
        }
        
        if ($client->floor === null || $client->floor === "") {
            $errors = 'El usuario tiene que tener el campo "planta" asignado para generar la factura en PDF.';
        }
        
        if ($client->door === null || $client->door === "") {
            $errors = 'El usuario tiene que tener el campo "puerta" asignado para generar la factura en PDF.';
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
            
            $stylesheet = file_get_contents(__DIR__ . '/../../../public/css/pdfStyles.css');
            $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
            $mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
            
            $mpdf->Output();
        } else {
            $cDeliver = new DeliverController();
            $cDeliver->showDelivers($errors);
        }
    }
    
    public function generateTemplateDeliver($deliver) {
        $mClient = new ClientModel();

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
                        <th class='pdf-category'>Fecha de pedido</th>
                        <th class='pdf-category'>Fecha de entrega aproximada</th>
                    </tr>
                    <tr>
                        <td colspan='2' class='pdf-data centrar-texto'>
                            <p>" . $deliver->id . "</p>
                        </td>
                        <td class='pdf-data centrar-texto'>
                            <p>" . date('Y-m-d', strtotime($deliver->date)) . "</p>
                        </td>
                        <td class='pdf-data'>
                            <p>" . date('Y-m-d', strtotime($deliver->date_deliver)) . "</p>
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

    public function generateAndSavePDF($del) {

        $mDeliver = new DeliverModel();
        $deliver = $mDeliver->getDeliver($del->id);

        // Generar el contenido HTML para el PDF
        $html = $this->generateTemplateDeliver($deliver[0]);
    
        // Crear una instancia de Mpdf con las configuraciones necesarias
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
    
        // Obtener el contenido del CSS
        $stylesheet = file_get_contents(__DIR__ . '/../../../public/css/pdfStyles.css');
    
        // Agregar el CSS al PDF
        $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
        $mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
    
        // Obtener el contenido del PDF
        $pdfContent = $mpdf->Output('', \Mpdf\Output\Destination::STRING_RETURN);
    
        $uniqueId = uniqid();
        // Guardar el PDF en el directorio temporal
        $pdfFilePath = __DIR__ . '/../../temporal/' . $uniqueId . '.pdf';
        file_put_contents($pdfFilePath, $pdfContent);
    
        return array($pdfFilePath, $uniqueId);
    }
    
    public function deletePDF($pdfFilePath) {
        if (file_exists($pdfFilePath)) {
            unlink($pdfFilePath);
            return true;
        } else {
            return false;
        }
    }
    
    
}
