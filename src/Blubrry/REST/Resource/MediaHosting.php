<?php
namespace Blubrry\REST\Resource;

/**
 * MediaHosting class
 *
 * @package Blubrry\REST\Resource
 */
class MediaHosting {
    /**
     * List Programs.
     *
     * @since 1.0.0
     *
     * @param int $limit
     * @param int $start
     *
     * @return array The API response.
     */
    public function listPrograms($limit = 100, $start = 0) {
        $path = '/2/media/index.json?limit=' . $limit . '&start=' . $start;

        return \Blubrry\REST\API::request($path, 'GET');
    }

    /**
     * List Umpublished Media.
     *
     * @since 1.0.0
     *
     * @param string $programKeyword
     * @param int $limit
     * @param int $start
     *
     * @return array The API response.
     */
    public function listUnpublished($programKeyword, $limit = 100, $start = 0) {
        $path='/2/media/' . $programKeyword . '/index.json?limit=' . $limit . '&start=' . $start;

        return \Blubrry\REST\API::request($path, 'GET');
    }

    /**
     * Publish Media.
     *
     * @since 1.0.0
     *
     * @param string $programKeyword
     * @param string $mediafile
     * @param bool $publish
     *
     * @return array The API response.
     */
    public function publishMedia($programKeyword, $mediafile, $publish = false) {
        $path = '/2/media/'. $programKeyword . '/' . $mediafile . '?format=json&publish=' . $publish;

        return \Blubrry\REST\API::request($path, 'GET');
    }

    /**
     * Delete Media.
     *
     * @since 1.0.0
     *
     * @param string $programKeyword
     * @param string $mediafile
     *
     * @return array The API response.
     */
    public function deleteMedia($programKeyword, $mediafile) {
        $path = '/2/media/' . $programKeyword . '/' . $mediafile . '?format=json';

        return \Blubrry\REST\API::request($path, 'DELETE');
    }

    /**
     * Adds media URLs to the migration queue.
     *
     * @since 1.0.0
     *
     * @param string $programKeyword
     * @param string $url
     * @param array $urls
     *
     * @return array The API response.
     */
    public function addMigrateMediaUrl($programKeyword, $url = null, $urls = null) {
        $path='/2/media/' . $programKeyword . '/migrate_add.json';

        if (!is_null($url)) {
            $body = [
                'url' => $url,
            ];
        }

        if (!empty($urls)) {
            $body = [
                'urls' => $urls,
            ];
        }

        return \Blubrry\REST\API::request($path, 'POST', $body);
    }

    /**
     * Remove media URLs from the migration queue.
     *
     * @since 1.0.0
     *
     * @param string $programKeyword
     * @param string $url
     * @param array $urls
     * @param array $ids
     *
     * @return array The API response.
     */
    public function removeMigrateMediaUrl($programKeyword, $url = null, $urls = null, $ids = null) {
        $path = '/2/media/' . $programKeyword . '/migrate_remove.json';

        if (!is_null($url)) {
            $body = [
                'url' => $url,
                'ids' => $ids,
            ];
        }

        if (!empty($urls)) {
            $body = [
                'urls' => $urls,
                'ids'  => $ids,
            ];
        }

        return \Blubrry\REST\API::request($path, 'POST', $body);
    }

    /**
     * Makes the uploaded media file publicly available.
     *
     * @since 1.0.0
     *
     * @param string $programKeyword
     * @param string $status
     * @param int $start
     * @param int $limit
     * @param array $id
     *
     * @return array The API response.
     */
    public function migrateStatus($programKeyword, $status = '', $start = 0, $limit = 100, $ids = null) {
        $path = '/2/media/' . $programKeyword . '/migrate_status.json';

        $body = [
            'status' => $status,
            'start'  => $start,
            'limit'  => $limit,
            'ids'    => $ids,
        ];

        return \Blubrry\REST\API::request($path, 'POST', $body);
    }

    /**
     * Uploads a media file to the server.
     *
     * @since 1.0.0
     *
     * @param string $programKeyword
     * @param string $mediaFile
     *
     * @return array The API response.
     */
    public function uploadMedia($programKeyword, $mediaFile) {
        $path = '/2/media/' . $programKeyword . '/' . $mediaFile . '?format=json';

        return \Blubrry\REST\API::request($path, 'PUT');
    }
}
