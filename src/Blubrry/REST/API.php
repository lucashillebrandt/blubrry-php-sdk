<?php

namespace Blubrry\REST;

/**
 * API Class
 *
 * @package Blubrry\REST;
 */
class API {
    /**
     * @var string Blubrry REST API URL.
     *
     * @since 1.0.0
     */
    const BLUBRRY_API_URL = 'https://api.blubrry.com';

    /**
     * Performs a request to the Blubrry REST API.
     *
     * @since 1.0.0
     *
     * @param string $uri
     * @param string $method
     * @param string $body
     */
    public static function request($uri, $method = 'GET', $body = null, $headers = null) {
        $url = self::BLUBRRY_API_URL . $uri;

        $response = \Blubrry\Lib\HttpClient::request($method, $url, $body, $headers);

        return $response;
    }
}
