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

    public static function createOrder()
    {
        $accessToken = self::getToken();

        $createOrderUrl = 'https://api.sandbox.paypal.com/v2/checkout/orders';

        $bodyParams = json_encode(
            array(
                'intent' => 'CAPTURE',
                'purchase_units' => array(
                    array(
                        'amount' => array(
                            'currency_code' => 'EUR',
                            'value' => 69.00
                        )
                    )
                )
            )
        );

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $createOrderUrl);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer ' . $accessToken,
            'Content-Type: application/json'
        )
        );
        curl_setopt($curl, CURLOPT_POSTFIELDS, $bodyParams);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "Error en la solicitud cURL: " . $err;
        } else {
            $orderData = json_decode($response);

            header('Location: ' . $orderData->links[1]->href);
            exit();
        }
    }

    public static function getTransactionDetails($transactionId)
    {
        $accessToken = self::getToken();

        $transactionDetailsUrl = 'https://api.sandbox.paypal.com/v2/checkout/orders/' . $transactionId;

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $transactionDetailsUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer ' . $accessToken,
            'Content-Type: application/json'
        )
        );

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "Error en la solicitud cURL: " . $err;
        } else {
            $transactionData = json_decode($response);

            // Aquí puedes hacer lo que quieras con los datos de la transacción
            return $transactionData;
        }
    }


}

