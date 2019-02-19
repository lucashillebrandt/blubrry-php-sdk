<?php
namespace Blubrry\REST\Resource;

/**
 * Social class
 *
 * @package Blubrry\REST\Resource
 */
class Social {
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
    public function updateListing($program_keyword, $body) {
        $path = '/2/social/' . $program_keyword . '/update-listing.json';

        $required = array(
            'title',
            'date',
            'media-url',
            'filesize',
        );

        foreach ($required as $item) {
            if (empty($body[$item])) {
                return false;
            }
        }
        
        return \Blubrry\REST\API::request($path, 'POST', $body);
    }
    
    /**
     * Get Social Options.
     *
     * @since 1.0.0
     *
     * @param string $program_keyword
     * @param array $params
     *
     * @return array The API response.
     */
    public function getSocial($program_keyword, $params) {
        $path = '/2/social/' . $program_keyword . '/get-social-options.json';

        return \Blubrry\REST\API::request($path, 'GET');
    }

    /**
     * Post to Social.
     *
     * @since 1.0.0
     *
     * @param string $program_keyword
     * @param array $body
     *
     * @return array The API response.
     */
    public function postSocial($program_keyword, $body) {
        $path='/2/social/' . $program_keyword . '/post.json';
    
        $required=array(
            'podcast-id',
            'post-data',
            'social-id',
            'social-type',
            'social-data',
        );
    
        foreach ($required as $item) {
            if (empty($body[$item])) {
                return false;
            }
        }

        return \Blubrry\REST\API::request($path, 'POST', $body);
    }
}
