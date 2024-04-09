<?php

class Crypto {
    private static $key = "R@ffl3Sp@1nTM";

    public static function encrypt_hash($data) {
        $ivSize = openssl_cipher_iv_length('aes-256-cbc');
        $iv = openssl_random_pseudo_bytes($ivSize);
        $encryptedData = openssl_encrypt($data, 'aes-256-cbc', self::$key, OPENSSL_RAW_DATA, $iv);
        return base64_encode($iv . $encryptedData);
    }

    public static function decrypt_hash($encryptedData) {
        $encryptedData = base64_decode($encryptedData);
        $ivSize = openssl_cipher_iv_length('aes-256-cbc');
        $iv = substr($encryptedData, 0, $ivSize);
        $data = openssl_decrypt(substr($encryptedData, $ivSize), 'aes-256-cbc', self::$key, OPENSSL_RAW_DATA, $iv);
        return $data;
    }
}