<?php
namespace Blubrry\REST\Resource;

/**
 * Auth class
 *
 * @package Blubrry\REST\Resource
 */
class Auth {
    /**
     * Constructor
     */
    public function __construct($clientId = null, $clientSecret = null) {
        $this->clientId     = $clientId;
        $this->clientSecret = $clientSecret;
    }

    /**
     * Gets Refresh Token.
     *
     * @since 1.0.0
     *
     * @param string $code
     * @param string $redirect_uri
     *
     * @return array The API response.
     */
    public function getRefresh($code, $redirectUri) {
        if (empty($code) || is_null($redirectUri) || is_null($this->clientId) || is_null($this->clientSecret)) {
            return false;
        }

        $path = '/oauth2/token';

        $body = [
            'grant_type'    => 'authorization_code',
            'redirect_uri'  => $redirectUri,
            'code'          => $code,
            'client_id'     => $this->clientId,
            'client_secret' => $this->clientSecret,
        ];

        return \Blubrry\REST\API::request($path, 'POST', $body);
    }

    /**
     * Gets new Access Token.
     *
     * @since 1.0.0
     *
     * @param string $refreshRoken
     *
     * @return array The API response.
     */
    public function getNewAccessToken($refreshToken) {
        if (empty($refreshToken) || is_null($this->clientId) || is_null($this->clientSecret)) {
            return false;
        }

        $path = '/oauth2/token';

        $body = [
            'grant_type'    => 'refresh_token',
            'refresh_token' => $refreshToken,
            'client_id'     => $this->clientId,
            'client_secret' => $this->clientSecret,
        ];

        return \Blubrry\REST\API::request($path, 'POST', $body);
    }
}
