<?php


/**
 * Battle Leaderboard
 * @author Phelix Juma <jumaphelix@kuzalab.com>
 * @copyright (c) 2020, Kuza Lab
 * @package Kuzalab
 */

namespace Phelix\Tournaments\Leaderboard;


use Phelix\Tournaments\Utils;

final class BattleRoyale {

    public static function generateStageLeaderboard($results) {
        return self::rankPlayers($results);
    }

    /**
     * Rank the players
     * @param $results
     * @return array
     */
    private static function rankPlayers($results) {

        // We get the points
        self::calculatePoints($results);

        // We rank the players
        self::rank($results);

        // reset keys
        $results = array_values($results);

        // We add the rank to them
        array_walk($results, function(&$value, $key) {
            $value['rank'] = ++$key;
        });
        return $results;
    }

    /**
     * Calculate the total points for each player
     *
     * @param $results
     */
    private static function calculatePoints(&$results) {

        $capacity = sizeof($results);

        array_walk($results, function(&$value, $key) use($capacity) {

            $value['kill_points'] = $value['kills'];
            $value['position_points'] = pow(($capacity - $value['position'] + 1), 2);
            $value['total_points'] = $value['kill_points'] + $value['position_points'];
        });
    }

    /**
     * Rank the players
     *
     * @param $scores
     */
    private static function rank(&$scores) {

        // We rank the players first by rounds
        Utils::stableuasort($scores, function($a, $b) {

            // sort by total points
            if ($a['total_points'] == $b['total_points']) {

                // same points, sort by position
                if ($a['position'] == $b['position']) {

                    // same position, sort by kills
                    if ($a['kills'] == $b['kills']) {
                        return 0;
                    }
                    return ($a['kills'] > $b['kills']) ? -1 : 1;

                } else {
                    return ($a['position'] > $b['position']) ? -1 : 1;
                }

            } else {
                return ($a['total_points'] > $b['total_points']) ? -1 : 1;
            }

        });
    }
}