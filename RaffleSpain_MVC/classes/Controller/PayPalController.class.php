<?php

class PayPalController extends Controller
{

    public static function getToken()
    {
        $clientId = PayPalData::getClientId();
        $secret = PayPalData::getSecret();
        $token_endpoint = PayPalData::getTokenEndpoint();

        $bodyParams = http_build_query(array('grant_type' => 'client_credentials'));

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $token_endpoint);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_USERPWD, $clientId . ":" . $secret);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $bodyParams);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "Error en la solicitud cURL: " . $err;
        } else {
            $data = json_decode($response);

            $access_token = $data->access_token;

            return $access_token;
        }
    }

    public static function createOrder($params)
{
    $accessToken = self::getToken();
    
    $createOrderUrl = 'https://api.sandbox.paypal.com/v2/checkout/orders';
    $returnUrl = 'http://localhost/M12/RaffleSpainTM/RaffleSpain_MVC/?PayPal/confirmPaymentCapture';
    $cancelUrl = 'http://localhost/M12/RaffleSpainTM/RaffleSpain_MVC/?cistella/show';
    
    $bodyParams = json_encode(
        array(
            'intent' => 'CAPTURE',
            'purchase_units' => array(
                array(
                    'reference_id' => 'd9f80740-38f0-11e8-b467-0ed5f89f718b',
                    'amount' => array(
                        'currency_code' => 'EUR',
                        'value' => $params[0]
                    )
                )
            ),
            'payment_source' => array(
                'paypal' => array(
                    'experience_context' => array(
                        'payment_method_preference' => 'IMMEDIATE_PAYMENT_REQUIRED',
                        'brand_name' => 'RAFFLESPAIN TM',
                        'locale' => 'en-US',
                        'user_action' => 'PAY_NOW',
                        'return_url' => $returnUrl,
                        'cancel_url' => $cancelUrl
                    )
                )
            )
        )
    );

    // Inicializamos la sesión cURL
    $curl = curl_init();

    // Configuramos las opciones de la sesión cURL
    curl_setopt($curl, CURLOPT_URL, $createOrderUrl);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Authorization: Bearer ' . $accessToken,
        'Content-Type: application/json',
        'PayPal-Request-Id: 7b92603e-77ed-4896-8e78-5dea2050476a'
    ));
    curl_setopt($curl, CURLOPT_POSTFIELDS, $bodyParams);

    // Ejecutamos la solicitud cURL
    $response = curl_exec($curl);
    $err = curl_error($curl);

    // Cerramos la sesión cURL
    curl_close($curl);

    // Verificamos si hubo algún error
    if ($err) {
        echo "Error en la solicitud cURL: " . $err;
    } else {
        // Decodificamos la respuesta JSON
        $orderData = json_decode($response);

        // Verificamos si se obtuvo el enlace de redirección
        if (isset($orderData->links[1])) {
            // Redirigimos al usuario al enlace de PayPal
            header('Location: ' . $orderData->links[1]->href);
            exit();
        } else {
            // Si no se obtuvo el enlace, mostramos un mensaje de error
            echo "No se pudo obtener el enlace de redirección de la respuesta de PayPal.";
        }
    }
}

    
    
public static function confirmPaymentCapture()
{
    // Obtener el token y PayerID del query string ($_GET)
    $token = $_GET['token'] ?? '';
    $payerID = $_GET['PayerID'] ?? '';

    if (empty($token) || empty($payerID)) {
        echo "Error: Falta token o PayerID en la solicitud.";
        return;
    }

    $accessToken = self::getToken();
    
    // Crear la URL de confirmación de captura con el token y el PayerID
    $captureUrl = 'https://api.sandbox.paypal.com/v2/checkout/orders/' . $token . '/capture';
    
    $curl = curl_init();
    
    curl_setopt($curl, CURLOPT_URL, $captureUrl);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Authorization: Bearer ' . $accessToken,
        'Content-Type: application/json'
    ));
    
    $response = curl_exec($curl);
    $err = curl_error($curl);
    
    curl_close($curl);
    
    if ($err) {
        echo "Error en la solicitud cURL: " . $err;
    } else {
        // Analizar y manejar la respuesta de confirmación aquí si es necesario
        return $response;
    }
}



    


}

