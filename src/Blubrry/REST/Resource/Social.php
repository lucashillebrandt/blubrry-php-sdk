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
     * @param array $params
     *
     * @return array The API response.
     */
    public function updateListing($program_keyword, $params) {
        $path = '/2/social/' . $program_keyword . '/update-listing.json';
        $body = [];

        $required = [
            'title',
            'date',
            'media-url',
            'filesize',
        ];

        $optional = [
            'feed-url',
            'guid',
            'subtitle',
            'duration',
            'explicit',
            'link',
            'image',
        ];

        foreach ($required as $item) {
            if (empty($params[$item])) {
                return false;
            } else {
                $body[$item] = $params[$item];
            }
        }

        foreach ($optional as $item) {
            if (!empty($params[$item])) {
                $body[$item] = $params[$item];
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

        $social_options = [];
        $social_options['social-options'] = [];

        $social_types = ['twitter', 'youtube', 'facebook'];
        $required_fields = ['social-id', 'social-image', 'social-title'];
        $attributes = [
            'html' => [
                'required' => [],
                'optional' => ['content'],
            ],
            'input-text' => [
                'required' => ['label', 'name'],
                'optional' => ['placeholder', 'help-text', 'rows', 'maxlength', 'value'],
            ],
            'input-checkbox' => [
                'required' => [],
                'optional' => ['label', 'checked', 'name', 'value'],
            ],
            'input-radio' => [
                'required' => [],
                'optional' => ['label', 'checked', 'name', 'value'],
            ],
        ];

        foreach ($social_types as $type) {
            foreach ($params[$type] as $item) {
                $SocialOption = [];

                foreach ($required_fields as $field) {
                    if (!empty($item[$field])) {
                        $socialOption[$field] = $item[$field];
                    } else {
                        return false;
                    }
                }
                
                $SocialOption['social-type'] = $type;
                $SocialOption['form-data'] = [];

                if (is_array($item['form-data'])) {
                    if (empty($item['form-data']['field-type'])) {
                        return false;
                    }

                    if (empty($item['form-data']['field-order'])) {
                        return false;
                    }

                    $type = $item['form-data']['field-type'];
                    $order = $item['form-data']['field-order'];

                    foreach ($attributes as $attr) {
                        if ($attr == $type) {
                            foreach ($attr['required'] as $req) {
                                if (empty($item['form-data'][$req])) {
                                    return false;
                                } else {
                                    $SocialOption['form-data'][$req] = $item['form-data'][$req];
                                }
                            }

                            foreach ($attr['optional'] as $opt) {
                                if (empty($item['form-data'][$opt])) {
                                    continue;
                                } else {
                                    $SocialOption['form-data'][$opt] = $item['form-data'][$opt];
                                }
                            }
                        }
                    }

                    $SocialOption['form-data']['field-type'] = $type;
                    $SocialOption['form-data']['field-order'] = $order;
                }

                $social_options['social-options'][] = $SocialOption;
            }
        }

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
        $path = '/2/social/' . $program_keyword . '/post.json';
    
        $required = [
            'podcast-id',
            'post-data',
            'social-id',
            'social-type',
            'social-data',
        ];
    
        foreach ($required as $item) {
            if (empty($body[$item])) {
                return false;
            }
        }

        $type = $body['social-type'];
        $twitter = ['content'];

        $facebook = [
            "title-$body['social-id']",
            "description-$body['social-id']",
            "destination-$body['social-id']",
        ];

        $youtube = [
            "title-$body['social-id']",
            "description-$body['social-id']",
        ];

        $array = [];

        if ('twitter' == $type) {
            $array = $twitter;
        }

        if ('facebook' == $type) {
            $array = $facebook;
        }

        if ('youtube' == $type) {
            $array = $youtube;
        }

        if (!empty($array)) {
            foreach ($array as $item) {
                if (is_null($body['social-data'][$item])) {
                    return false;
                }
            }
        }

        return \Blubrry\REST\API::request($path, 'POST', $body);
    }
}
