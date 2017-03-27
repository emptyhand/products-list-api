<?php

namespace AppBundle;

use Lexik\Bundle\JWTAuthenticationBundle\Services\KeyLoader\OpenSSLKeyLoader;

class EnvKeyLoader extends OpenSSLKeyLoader
{
    /**
     * @var string
     */
    private $privateKey;

    /**
     * @var string
     */
    private $publicKey;

    protected function getKeyFromEnv($type)
    {
        if (!in_array($type, [self::TYPE_PUBLIC, self::TYPE_PRIVATE])) {
            throw new \InvalidArgumentException(sprintf('The key type must be "public" or "private", "%s" given.', $type));
        }

        if (self::TYPE_PUBLIC === $type) {
            return $this->publicKey;
        }

        if (self::TYPE_PRIVATE === $type) {
            return $this->privateKey;
        }
    }

    /**
     * {@inheritdoc}
     *
     * @throws \RuntimeException If the key cannot be read
     * @throws \RuntimeException Either the key or the passphrase is not valid
     */
    public function loadKey($type)
    {
        $encryptedKey = $this->getKeyFromEnv($type);

        $key          = call_user_func_array(
            sprintf('openssl_pkey_get_%s', $type),
            self::TYPE_PRIVATE == $type ? [$encryptedKey, $this->getPassphrase()] : [$encryptedKey]
        );

        if (!$key) {
            $sslError = '';
            while ($msg = trim(openssl_error_string(), " \n\r\t\0\x0B\"")) {
                if (substr($msg, 0, 6) === 'error:') {
                    $msg = substr($msg, 6);
                }
                $sslError .= "\n ".$msg;
            }
            throw new \RuntimeException(
                sprintf('Failed to load %s key: %s', $type, $sslError)
            );
        }

        return $key;
    }
}