<?php


use \Firebase\JWT\JWT;
/**
 * IMPORTANT:
 * You must specify supported algorithms for your application. See
 * https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
 * for a list of spec-compliant algorithms.
 */


$GLOBALS["key"] = "ed8876355fdcb00ec190d79038424b713ac91fea0f44446f394d2163cc6953c080c1fa81bd30d3cae2d386ca372619abc7c976cd728fe4c669ef45ffdb6748b563ce566d06a35ef164bc87d7aebab423ec496db853cdaa29b35352a5046d84e4c243cb0792a83afd305f56adda0c0845ea23c984bda8f61e65cb1c3e9e1fe11be1a738fa4e9b4c88d426ee25c9d09c482693ccd3a2e887e9040bbe7d2f5928c6d9bca816a077dc4270d635aa71272c35a1fe9a95eafc73cb3b9b73f76a1f11e3f0164d62510751b3f1ac60eca584046d688bf54bde1cd62071f42c6642aad2b2d628535bd4f3e8ad46632b533db381d5c7aea04363a69848e45e35fb2557536e";



function signJwt($payload) {
    global $key;

    // $payload = array(
    //     $response["token"]
    // );
    
    return 
        base64_encode(json_encode([
            "jwt" => JWT::encode($payload, $GLOBALS["key"])
        ]));
}

function decodeJwt($token) {
    global $key;

    return JWT::decode((json_decode(base64_decode($token)))->jwt, $key, array('HS256'));

}

