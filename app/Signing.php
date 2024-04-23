<?php

namespace App;

use Illuminate\Support\Str;

class Signing
{
    public static function getPrivateKey()
    {
        return file_get_contents("../keys/private_key.pem");
    }

    public static function getPublicKey()
    {
        return file_get_contents("../keys/public_key.pem");
    }

    public static function sign($data) {
        openssl_sign($data, $signature, self::getPrivateKey(), OPENSSL_ALGO_SHA256);
        $signature = base64_encode($signature);
        return $signature;
    }

    public static function checkSignature($data, $signature, $publicKey) {
        $r = openssl_verify($data, base64_decode($signature), $publicKey, OPENSSL_ALGO_SHA256);
        return $r == 1;
    }
}
