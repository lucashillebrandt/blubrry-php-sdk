<?php
namespace Blubrry\REST\Resource;

/**
 * PodcastStatistics class
 *
 * @package Blubrry\REST\Resource
 */
class PodcastStatistics {
    /**
     * Get Summary.
     *
     * @since 1.0.0
     *
     * @param string $programKeyword
     * @param string $month
     * @param string $year
     *
     * @return array The API response.
     */
    public function summary($programKeyword, $month = null, $year = null) {
        $path = '/2/stats/' . $programKeyword . '/summary.json';
        $qs = '';

        if (! is_null($month)) {
            $qs += '?month=' . $month;
        }

        if (! is_null($year)) {
            $qs += '?year=' . $year;
        }

        if (! is_null($year) && ! is_null($month)) {
            $qs = '?month=' . $month . '&year=' . $year;
        }

        return \Blubrry\REST\API::request($path . $qs, 'GET');
    }
    
    /**
     * Get totals from a specific podcast.
     *
     * @since 1.0.0
     *
     * @param string $programKeyword
     * @param array $params
     *
     * @return array The API response.
     */
    public function totals($programKeyword, $params) {
        $path = '/2/stats/' . $programKeyword . '/totals.json';

        if (empty($params)) {
            return false;
        }
    
        $qs = (!empty($params) && is_array($params)) ? http_build_query($qs) : '';

        return \Blubrry\REST\API::request($path . $qs, 'GET');
    }
}
