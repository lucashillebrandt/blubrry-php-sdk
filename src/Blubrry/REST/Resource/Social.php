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
     * @param string $programKeyword
     * @param array $params
     *
     * @return array The API response.
     */
    public function updateListing($programKeyword, $params) {
        $path = '/2/social/' . $programKeyword . '/update-listing.json';
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
     * @param string $programKeyword
     * @param array $params
     *
     * @return array The API response.
     */
    public function getSocial($programKeyword, $params) {
        $path = '/2/social/' . $programKeyword . '/get-social-options.json';

        $socialOptions = [
           'social-options' => [], 
        ];

        $socialTypes    = ['twitter', 'youtube', 'facebook'];
        $requiredFields = ['social-id', 'social-image', 'social-title'];

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

        foreach ($socialTypes as $type) {
            foreach ($params[$type] as $item) {
                $currentOption = [];

                foreach ($requiredFields as $field) {
                    if (!empty($item[$field])) {
                        $currentOption[$field] = $item[$field];
                    } else {
                        return false;
                    }
                }
                
                $currentOption['social-type'] = $type;
                $currentOption['form-data']   = [];

                if (is_array($item['form-data'])) {
                    if (empty($item['form-data']['field-type'])) {
                        return false;
                    }

                    if (empty($item['form-data']['field-order'])) {
                        return false;
                    }

                    $type  = $item['form-data']['field-type'];
                    $order = $item['form-data']['field-order'];

                    foreach ($attributes as $attr) {
                        if ($attr == $type) {
                            foreach ($attr['required'] as $req) {
                                if (empty($item['form-data'][$req])) {
                                    return false;
                                } else {
                                    $currentOption['form-data'][$req] = $item['form-data'][$req];
                                }
                            }

                            foreach ($attr['optional'] as $opt) {
                                if (!empty($item['form-data'][$opt])) {
                                    $currentOption['form-data'][$opt] = $item['form-data'][$opt];
                                }
                            }
                        }
                    }

                    $currentOption['form-data']['field-type']  = $type;
                    $currentOption['form-data']['field-order'] = $order;
                }

                $socialOptions['social-options'][] = $currentOption;
            }
        }

        return \Blubrry\REST\API::request($path, 'GET');
    }

    /**
     * Post to Social.
     *
     * @since 1.0.0
     *
     * @param string $programKeyword
     * @param array $body
     *
     * @return array The API response.
     */
    public function postSocial($programKeyword, $body) {
        $path = '/2/social/' . $programKeyword . '/post.json';
    
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

        $type   = $body['social-type'];
        $social = [];

        if ('twitter' == $type) {
            $social = ['content'];
        } else if ('facebook' == $type) {
            $social = [
                "title-$body['social-id']",
                "description-$body['social-id']",
                "destination-$body['social-id']",
            ];
        } else if ('youtube' == $type) {
            $social = [
                "title-$body['social-id']",
                "description-$body['social-id']",
            ];
        } else {
            return false;
        }

        foreach ($social as $item) {
            if (is_null($body['social-data'][$item])) {
                return false;
            }
        }

        return \Blubrry\REST\API::request($path, 'POST', $body);
    }
}
