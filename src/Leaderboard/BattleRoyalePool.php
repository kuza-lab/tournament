<?php


/**
 * Pool (Groups) for battle royale tournaments Leaderboard
 * @author Phelix Juma <jumaphelix@kuzalab.com>
 * @copyright (c) 2020, Kuza Lab
 * @package Kuzalab
 */

namespace Phelix\Tournaments\Leaderboard;


use Phelix\Tournaments\Utils;

final class BattleRoyalePool {

    public static function generateStageLeaderboard($results) {
        return self::rankPlayers($results);
    }

    /**
     * Rank the players
     * @param $results
     * @return array
     */
    private static function rankPlayers($results) {

        $players = [];

        foreach ($results as $result) {

            $rankedStagePlayers = BattleRoyale::generateStageLeaderboard($result['matches']);

            array_walk($rankedStagePlayers, function(&$value, $key) use($result) {
               $value['group'] = $result['group'];
            });

            $players = array_merge($players, $rankedStagePlayers);
        }

        // We rank the players
        self::rank($players);

        // reset keys
        $rankedPlayers = array_values($players);

        // we add the rank
        array_walk($rankedPlayers, function(&$value, $key) {
            $value['stage_rank'] = ++$key;
        });

        return $rankedPlayers;
    }

    /**
     * Rank the players based on the stage
     *
     * @param $scores
     */
    private static function rank(&$scores) {

        // We rank the players first by rounds
        Utils::stableuasort($scores, function($a, $b) {

            // Rank by group rank
            if ($a['rank'] == $b['rank']) {

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

            } else {
                return ($a['rank'] < $b['rank']) ? -1 : 1; // ascending order ranking
            }
        });
    }
}