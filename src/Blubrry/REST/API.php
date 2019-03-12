<?php
namespace Blubrry\REST;

/**
 * API Class
 *
 * @package Blubrry\REST;
 */
class API {
    /**
     * @var string Blubrry API Access Token.
     *
     * @since 1.0.0
     */
    public static $accessToken = null;

    /**
     * Constructor
     *
     * @since 1.0.0
     */
    public function __construct($accessToken = null) {
        self::$accessToken = $accessToken;
    }

    /**
     * @var string Blubrry REST API URL.
     *
     * @since 1.0.0
     */
    const BLUBRRY_API_URL = 'https://api.blubrry.com';

    /**
     * Media Hosting resource.
     *
     * @since 1.0.0
     *
     * @return \Blubrry\REST\Resource\MediaHosting Resource instance.
     */
    public function mediaHosting() {
        return new \Blubrry\REST\Resource\MediaHosting();
    }

    /**
     * Podcast Statistics resource.
     *
     * @since 1.0.0
     *
     * @return \Blubrry\REST\Resource\PodcastStatistics Resource instance.
     */
    public function podcastStatistics() {
        return new \Blubrry\REST\Resource\PodcastStatistics();
    }

    /**
     * Social resource.
     *
     * @since 1.0.0
     *
     * @return \Blubrry\REST\Resource\Social Resource instance.
     */
    public function social() {
        return new \Blubrry\REST\Resource\Social();
    }
    
    /**
     * Auth resource.
     *
     * @since 1.0.0
     *
     * @return \Blubrry\REST\Resource\Auth Resource instance.
     */
    public function auth($clientId, $clientSecret) {
        return new \Blubrry\REST\Resource\Auth($clientId, $clientSecret);
    }

    /**
     * Performs a request to the Blubrry REST API.
     *
     * @since 1.0.0
     *
     * @param string $uri
     * @param string $method
     * @param string $body
     * @param string $headers
     * @param array  $options
     *
     * @return array The API response.
     */
    public static function request($uri, $method = 'GET', $body = null, $headers = null, $options = null) {
        $url = self::BLUBRRY_API_URL . $uri;
        $headers = [];

        if ( 'PUT' != $method ) {
            $body      = http_build_query($body);
            $headers[] = 'Content-type: application/x-www-form-urlencoded';
        }

        $headers[] = 'Authorization: Bearer ' . self::$accessToken;

        $response = \Blubrry\Lib\HttpClient::request($method, $url, $body, $headers, $options);

        return json_decode($response, true);
    }
}
