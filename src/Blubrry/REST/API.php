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
     * Performs a request to the Blubrry REST API.
     *
     * @since 1.0.0
     *
     * @param string $uri
     * @param string $method
     * @param string $body
     *
     * @return array The API response.
     */
    public static function request($uri, $method = 'GET', $body = null, $headers = null) {
        $url = self::BLUBRRY_API_URL . $uri;

        $response = \Blubrry\Lib\HttpClient::request($method, $url, $body, $headers);

        return json_decode($response, true);
    }
}
