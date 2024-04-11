<?php

class PayPalData {
    private static $api = 'https://api.sandbox.paypal.com';
    private static $clientId = 'AZkojbZ1IzU-I-J0BeFt5qMhd6DmR7lrC_p64M5M2wJ3eY7sRVYrqEkh19dLhB3zXamTe-k4MvV5GJ4Z';
    private static $secret = 'EMFwlN8U4I6V0SbpwKHzYmps9GZSeXuqnC3FGrpLPX-7_EyJA9_ADFOq2VrknmTLpyPdcnbExJUQX0u9';
    private static $bodyEncodedParams = ['application/x-www-form-urlencoded','grant_type', 'client_credentials'];
    private static $token_endpoint = '/v1/oauth2/token';

    public static function getApi() {
        return self::$api;
    }

    public static function getClientId() {
        return self::$clientId;
    }

    public static function getSecret() {
        return self::$secret;
    }

    public static function getBodyEncodedParams() {
        return self::$bodyEncodedParams;
    }

    public static function getTokenEndpoint() {
        return self::$api . self::$token_endpoint;
    }

}