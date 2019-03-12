<?php
namespace Blubrry\Lib;

/**
 * HttpClient Class
 *
 * @package Blubrry\Lib
 */
class HttpClient {
    /**
     * @var int HTTP status code.
     *
     * @since 1.0.0
     */
    private static $httpStatusCode = null;

    /**
     * Gets the HTTP status code for the latest request.
     *
     * @since 1.0.0
     */
    public static function getHttpStatusCode() {
        return self::$httpStatusCode;
    }

    /**
     * Performs an HTTP request via curl.
     *
     * @param string $method
     * @param string $url
     * @param string $queryString
     * @param array  $headers
     * @param string $auth
     * @param int    $timeout
     * @param bool   $secure
     *
     * @since 1.0.0
     */
    public static function request(
        $method,
        $url,
        $queryString,
        $headers = null,
        $opts = null,
        $auth = null,
        $timeout = null,
        $secure = true
    ) {
        $ch = curl_init();

        if (preg_match('/(POST|PUT|DELETE)/', $method)) {
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);

            if (preg_match('/(PUT|DELETE)/', $method)) {
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
            }

            if (!empty($queryString)) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $queryString);
            }
        } else {
            curl_setopt($ch, CURLOPT_URL, $url . $queryString);
        }

        if (!is_null($headers)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }

        if (!is_null($auth)) {
            curl_setopt($ch, CURLOPT_USERPWD, $auth);
        }

        if (!is_null($timeout)) {
            curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        }

        if (!$secure) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if (!is_null($opts) && is_array($opts)) {
            foreach ($opts as $key => $value) {
                curl_setopt($ch, $key, $value);
            }
        }

        $response = curl_exec($ch);

        self::$httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        return $response;
    }
}
