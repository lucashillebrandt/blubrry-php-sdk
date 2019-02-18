<?php

namespace Blubrry\REST\Resource;

/**
 * PodcastStatistics class 
 *
 * @package Blubrry\REST\Resource
 */
class PodcastStatistics {
    public function summary($program_keyword, $month = null, $year = null) {
        $path="/2/stats/$program_keyword/summary.json";
        $qs="";

        if ( ! is_null( $month ) ) {
            $qs+="?month=$month";
        }

        if ( ! is_null ( $year ) ) {
            $qs+="?year=$year";
        }

        if ( ! is_null ( $year ) && ! is_null ( $month ) ) {
            $qs="?month=${month}&year=$year";
        }

        return \Blubrry\REST\API::request( $path . $qs, 'GET' );
    }
    
    public function totals() {
        return 1;
    }
}
