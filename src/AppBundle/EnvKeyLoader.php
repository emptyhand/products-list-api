<?php

namespace AppBundle;

use Lexik\Bundle\JWTAuthenticationBundle\Services\KeyLoader\OpenSSLKeyLoader;

class EnvKeyLoader extends OpenSSLKeyLoader
{
    public function loadKey($type)
    {
        // create key files from env variables
        $content = getenv(strtoupper($type) . '_PEM');
        $path = getenv('JWT_' . strtoupper($type) . '_KEY_PATH');

        if (!file_exists($path)) {
            file_put_contents($path, $content);
        }

        return parent::loadKey($type);
    }
}