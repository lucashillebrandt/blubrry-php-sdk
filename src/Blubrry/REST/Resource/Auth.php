<?php
namespace Blubrry\REST\Resource;

/**
 * Auth class
 *
 * @package Blubrry\REST\Resource
 */
class Auth {
    /**
     * Update the listing.
     *
     * @since 1.0.0
     *
     * @param string $program_keyword
     * @param array $body
     *
     * @return array The API response.
     */
    public function getRefresh($code, $redirect_uri) {
        if (empty($code)) {
            return false;
        }

        if (empty($redirect_uri)) {
            return false;
        }

        $path = '/oauth2/token?grant_type=authorization_code';
        $path += '&code' . $code;
        $path += '&redirect_uri=' . $redirect_uri;

        return \Blubrry\REST\API::request($path, 'GET');
    }
}
