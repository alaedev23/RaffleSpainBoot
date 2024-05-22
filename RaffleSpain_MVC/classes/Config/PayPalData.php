<?php

/**
 * Clase que contiene datos de configuración para la integración con PayPal.
 */
class PayPalData {
   
    /** @var string La URL base de la API de PayPal. */
    private static $api = 'https://api.sandbox.paypal.com';
    
    /** @var string El ID de cliente de PayPal. */
    private static $clientId = 'AZkojbZ1IzU-I-J0BeFt5qMhd6DmR7lrC_p64M5M2wJ3eY7sRVYrqEkh19dLhB3zXamTe-k4MvV5GJ4Z';
    
    /** @var string El secreto de PayPal. */
    private static $secret = 'EMFwlN8U4I6V0SbpwKHzYmps9GZSeXuqnC3FGrpLPX-7_EyJA9_ADFOq2VrknmTLpyPdcnbExJUQX0u9';
    
    /** @var string El punto final para obtener el token de acceso de PayPal. */
    private static $token_endpoint = '/v1/oauth2/token';

    /**
     * Obtiene la URL base de la API de PayPal.
     *
     * @return string URL base de la API de PayPal.
     */
    public static function getApi() {
        return self::$api;
    }

    /**
     * Obtiene el ID de cliente de PayPal.
     *
     * @return string ID de cliente de PayPal.
     */
    public static function getClientId() {
        return self::$clientId;
    }

    /**
     * Obtiene el secreto de PayPal.
     *
     * @return string Secreto de PayPal.
     */
    public static function getSecret() {
        return self::$secret;
    }

    /**
     * Obtiene el punto final para obtener el token de acceso de PayPal.
     *
     * @return string Punto final para obtener el token de acceso de PayPal.
     */
    public static function getTokenEndpoint() {
        return self::$api . self::$token_endpoint;
    }

}