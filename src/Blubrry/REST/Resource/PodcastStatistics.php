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
     * @param string $program_keyword
     * @param string $month
     * @param string $year
     */
    public function summary($program_keyword, $month = null, $year = null) {
        $path="/2/stats/$program_keyword/summary.json";
        $qs="";

        if (! is_null($month)) {
            $qs+="?month=$month";
        }

        if (! is_null($year)) {
            $qs+="?year=$year";
        }

        if (! is_null($year) && ! is_null($month)) {
            $qs="?month=${month}&year=$year";
        }

        return \Blubrry\REST\API::request($path . $qs, 'GET');
    }
    
    /**
     * Get totals from a specific podcast.
     *
     * @since 1.0.0
     *
     * @param string $program_keyword
     * @param array $params
     */
    public function totals($program_keyword, $params) {
        $path = "/2/stats/$program_keyword/totals.json";
        $qs="?";

        if (empty($params)) {
            return false;
        }
    
        foreach ($params as $key => $item) {
            $qs+="${key}=${item}&";
        }

        return \Blubrry\REST\API::request($path . $qs, 'GET');
    }
}
