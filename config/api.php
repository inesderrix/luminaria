<?php
class JWT {
    private static $secret = 'ada_lovelace';

    public static function encode($payload, $exp = 3600) {
        $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
        $payload['exp'] = time() + $exp;
        $payload = json_encode($payload);

        $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
        $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));
        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, self::$secret, true);
        $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

        return $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;
    }

    public static function decode($token) {
        $parts = explode('.', $token);
        if(count($parts) !== 3) return false;

        list($base64UrlHeader, $base64UrlPayload, $base64UrlSignature) = $parts;
        $header = json_decode(base64_decode($base64UrlHeader), true);
        $payload = json_decode(base64_decode($base64UrlPayload), true);
        $signature = base64_decode(str_replace(['-', '_'], ['+', '/'], $base64UrlSignature));

        $valid = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, self::$secret, true);
        if(!hash_equals($valid, $signature)) {
            return false;
        }
        if(isset($payload['exp']) && time() > $payload['exp']){
            return false;
        }
        return $payload;
    }
}
?>