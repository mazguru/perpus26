<?php

namespace App\Libraries;

class Token
{
    /**
     * @var string
     */
    private $token;

    /**
     * @var string|null
     */
    private $oldToken;

    /**
     * Class constructor
     */
    public function __construct()
    {
        if (session()->has('token')) {
            $this->oldToken = session('token');
        }
    }

    /**
     * Generate new token
     *
     * @return string
     */
    private function setToken(): string
    {
        $ip = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
        $uniqid = uniqid(mt_rand(), true);
        return md5($ip . $uniqid);
    }

    /**
     * Get or generate token, and store it to session
     *
     * @return string
     */
    public function getToken(): string
    {
        $this->token = $this->setToken();
        session()->set('token', $this->token);
        return $this->token;
    }

    /**
     * Validate incoming token
     *
     * @param string $token
     * @return bool
     */
    public function isValidToken(string $token): bool
    {
        return $token === $this->oldToken;
    }
}
