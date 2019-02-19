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
        $path='/2/media/index.json?limit=' . $limit . '&start=' . $start;

        return \Blubrry\REST\API::request($path, 'GET');
    }

    /**
     * List Umpublished Media.
     *
     * @since 1.0.0
     *
     * @param string $program_keyword
     * @param int $limit
     * @param int $start
     *
     * @return array The API response.
     */
    public function listUnpublished($program_keyword, $limit = 100, $start = 0) {
        $path='/2/media/' . $program_keyword . '/index.json?limit=' . $limit . '&start=' . $start;

        return \Blubrry\REST\API::request($path, 'GET');
    }

    /**
     * Publish Media.
     *
     * @since 1.0.0
     *
     * @param string $program_keyword
     * @param string $mediafile
     * @param bool $publish
     *
     * @return array The API response.
     */
    public function publishMedia($program_keyword, $mediafile, $publish = false) {
        $path='/2/media/'. $program_keyword . '/' . $mediafile . '?format=json&publish=' . $publish;

        return \Blubrry\REST\API::request($path, 'GET');
    }

    /**
     * Delete Media.
     *
     * @since 1.0.0
     *
     * @param string $program_keyword
     * @param string $mediafile
     *
     * @return array The API response.
     */
    public function deleteMedia($program_keyword, $mediafile) {
        $path='/2/media/' . $program_keyword . '/' . $mediafile . '?format=json';

        return \Blubrry\REST\API::request($path, 'DELETE');
    }

    /**
     * Adds media URLs to the migration queue.
     *
     * @since 1.0.0
     *
     * @param string $program_keyword
     * @param string $url
     * @param array $urls
     *
     * @return array The API response.
     */
    public function addMigrateMediaUrl($program_keyword, $url = null, $urls = null) {
        $path='/2/media/' . $program_keyword . '/migrate_add.json';

        if (! is_null($url)) {
            $body = array(
                'url' => $url,
            );
        }

        if (! empty($urls)) {
            $body = array(
                'urls' => $urls,
            );
        }

        return \Blubrry\REST\API::request($path, 'POST', $body);
    }

    /**
     * Remove media URLs from the migration queue.
     *
     * @since 1.0.0
     *
     * @param string $program_keyword
     * @param string $url
     * @param array $urls
     * @param array $ids
     *
     * @return array The API response.
     */
    public function removeMigrateMediaUrl($program_keyword, $url = null, $urls = null, $ids = null) {
        $path = '/2/media/' . $program_keyword . '/migrate_remove.json';

        if (! is_null($url)) {
            $body = array(
                'url' => $url,
                'ids' => $ids,
            );
        }

        if (! empty($urls)) {
            $body = array(
                'urls' => $urls,
                'ids'  => $ids,
            );
        }

        return \Blubrry\REST\API::request($path, 'POST', $body);
    }

    /**
     * Makes the uploaded media file publicly available.
     *
     * @since 1.0.0
     *
     * @param string $program_keyword
     * @param string $status
     * @param int $start
     * @param int $limit
     * @param array $id
     *
     * @return array The API response.
     */
    public function migrateStatus($program_keyword, $status = '', $start = 0, $limit = 100, $ids = null) {
        $path = '/2/media/' . $program_keyword . '/migrate_status.json';

        $body = array(
            'status' => $status,
            'start' => $start,
            'limit' => $limit,
            'ids' => $ids,
        );

        return \Blubrry\REST\API::request($path, 'POST', $body);
    }

    /**
     * Uploads a media file to the server.
     *
     * @since 1.0.0
     *
     * @param string $program_keyword
     * @param string $media_file
     *
     * @return array The API response.
     */
    public function uploadMedia($program_keyword, $media_file) {
        $path = '/2/media/' . $program_keyword . '/' . $media_file . '?format=json';

        return \Blubrry\REST\API::request($path, 'PUT');
    }
}
