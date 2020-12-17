<?php


/**
 * Single Elimination Leaderboard
 * @author Phelix Juma <jumaphelix@kuzalab.com>
 * @copyright (c) 2020, Kuza Lab
 * @package Kuzalab
 */

namespace Phelix\Tournaments\Leaderboard;


use Phelix\Tournaments\Utils;

final class Pool {

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

            $stageResults = $result['rounds'];
            $rankedStagePlayers = [];

            switch ($result['type']) {
                case 'RR':
                    $rankedStagePlayers = RoundRobin::generateStageLeaderboard($stageResults);
                    break;
                case 'SE':
                    $rankedStagePlayers = SingleElimination::generateStageLeaderboard($stageResults);
                    break;
                case 'DE':
                    $rankedStagePlayers = DoubleElimination::generateStageLeaderboard($stageResults);
                    break;
            }

            array_walk($rankedStagePlayers, function(&$value, $key) use($result) {
               $value['group'] = $result['group'];
            });

            $players = array_merge($players, $rankedStagePlayers);
        }

        // We rank the players
        self::rank($players);

        // reset keys
        $players = array_values($players);

        $rankedPlayers = [];

        // We get unique players and assign a rank to them
        array_walk($players, function(&$value, $key) use($players, &$rankedPlayers) {

            // We check if it's a duplicate value
            $chunk = array_slice($players, 0, $key);

            if (!Utils::searchMultiArrayByKeyReturnKeys($chunk, "player_id", $value['player_id'])) {
                $rankedPlayers[] = $value;
            }
        });

        $rankedPlayers = array_values($rankedPlayers);

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

                // same rank, rank by points
                if ($a['points'] == $b['points']) {

                    // same points, sort by goal difference
                    if ($a['total_goal_difference'] == $b['total_goal_difference']) {

                        // same goal difference, sort by total score
                        if ($a['total_score'] == $b['total_score']) {
                            return 0;
                        }
                        return ($a['total_score'] > $b['total_score']) ? -1 : 1;

                    } else {
                        return ($a['total_goal_difference'] > $b['total_goal_difference']) ? -1 : 1;
                    }

                } else {
                    return ($a['points'] > $b['points']) ? -1 : 1;
                }

            } else {
                return ($a['rank'] < $b['rank']) ? -1 : 1; // ascending order ranking
            }
        });
    }
}