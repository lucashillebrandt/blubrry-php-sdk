<?php

namespace Blubrry\REST\Resource;

/**
 * MediaHosting class 
 *
 * @package Blubrry\REST\Resource
 */
class MediaHosting {
    public function list_programs($limit = 100, $start = 0) {
        # path: /2/media/index.json
        # method: GET
        # params: limit (optional), start (optional).

        $path="/2/media/index.json?limit=$limit&start=$start";

        return \Blubrry\REST\API::request( $path, 'GET' );
    }

    public function list_unpublished($program_keyword, $limit = 100, $start = 0) {
        # path: /2/media/program_keyword/index.json
        # method: GET
        # params: program_keyword (required), limit (optional), start (optional).
        
        $path="/2/media/$program_keyword/index.json?limit=$limit&start=$start";

        return \Blubrry\REST\API::request( $path, 'GET' );
    }

    public function publish_media($program_keyword, $mediafile, $publish = false) {
        # path: /2/media/my_program/mediafile.ext?format=json
        # method: GET
        # params: mediafile.ext, program_keyword

        $path="/2/media/$program_keyword/$mediafile?format=json&publish=$publish";

        return \Blubrry\REST\API::request( $path, 'GET' );
    }

    public function delete_media($program_keyword, $mediafile) {
        # path: /2/media/program_keyword/mediafile.ext?format=json
        # method: DELETE
        # params: mediafile.ext, program_keyword

        $path="/2/media/$program_keyword/$mediafile?format=json";

        return \Blubrry\REST\API::request( $path, 'DELETE' );
    }

    public function add_migrate_media_url( $program_keyword, $url = null, $urls = null) {
        # path: /2/media/program_keyword/migrate_add.json
        # method: POST
        # params: program_keyword, URL, URLS(separated by new lines)

        $path="/2/media/$program_keyword/migrate_add.json";

        if ( ! is_null($url) ) {
            $body = array(
                "url" => $url,
            );
        }

        if ( ! empty( $urls ) ) {
            $body = array(
                "urls" => $urls, 
            );
        }

        return \Blubrry\REST\API::request( $path, 'POST', $body );
    }

    public function remove_migrate_media_url($program_keyword, $url = null, $urls = null, $ids = null) {
        # path: /2/media/program_keyword/migrate_remove.json
        # method: POST
        # params: program_keyword, url,urls,ids

        $path = "/2/media/$program_keyword/migrate_remove.json";

        if ( ! is_null($url) ) {
            $body = array(
                "url" => $url,
                "ids" => $ids,
            );
        }

        if ( ! empty( $urls ) ) {
            $body = array(
                "urls" => $urls,
                "ids"  => $ids, 
            );
        }

        return \Blubrry\REST\API::request( $path, 'POST', $body);
    }

    public function migrate_status($program_keyword, $status = "", $start = 0, $limit = 100, $ids) {
        # path: /2/media/program_keyword/migrate_status.json
        # method: GET
        # params: status ( ‘queued’, ‘downloading’, ‘completed’, ‘skipped’, ‘error’ ), start, limit, ids.

        $path = "/2/media/$program_keyword/migrate_status.json";

        $body = array(
            "status" => $status,
            "start" => $start,
            "limit" => $limit,
            "ids" => $ids,
        );

        return \Blubrry\REST\API::request( $path, 'POST', $body );
    }

    public function upload_media( $program_keyword, $media_file ) {
        # path: /2/media/program_keyword/mediafile.ext?format=json
        # method: PUT
        # params: program_keyword, mediafile.ext

        $path = "/2/media/$program_keyword/$media_file?format=json";

        return \Blubrry\REST\API::request( $path, 'PUT' );
    }
}
