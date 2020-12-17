<?php


/**
 * Single Elimination Leaderboard
 * @author Phelix Juma <jumaphelix@kuzalab.com>
 * @copyright (c) 2020, Kuza Lab
 * @package Kuzalab
 */

namespace Phelix\Tournaments\Leaderboard;


use Phelix\Tournaments\Utils;

final class RoundRobin {

    public static function generateStageLeaderboard($results) {
        return self::rankPlayers($results);
    }

    /**
     * Flattening of the array of results into a one layer associative array.
     * @param $results
     * @return array
     */
    private static function flattenScores($results) {

        $flattened_results = [];

        foreach ($results as $result) {

            $player_j = 0; // just an array position holder for the player. Can be 0 or 1 because there are only two players
            foreach ($result['scores'] as $score) {

                $opponent_player = $player_j == 0 ? 1 : 0; // find the opponent player array position

                $flattened_results[] = [
                    "match_name"        => $result['name'],
                    "player_id"         => $score['player_id'],
                    "score"             => $score['score'],
                    "is_winner"         => $result['scores'][$player_j]['score'] > $result['scores'][$opponent_player]['score'] ? 1 : 0,
                    "is_draw"           => $result['scores'][$player_j]['score'] == $result['scores'][$opponent_player]['score'] ? 1 : 0,
                    "goal_difference"   => $result['scores'][$player_j]['score'] - $result['scores'][$opponent_player]['score']
                ];
                $player_j++;
            }


        }
        return $flattened_results;

    }

    /**
     * Calculate the total points for a player
     *
     * @param $playerId
     * @param $scores
     * @return array
     */
    private static function calculatePlayerPoints($playerId, $scores) {

        $points = 0;
        $goalDifference = 0;
        $totalScore = 0;

        foreach ($scores as $score) {
            if ($score['player_id'] == $playerId ) {

                $goalDifference += $score['goal_difference'];
                $totalScore += $score['score'];

                if ($score['is_winner'] == 1) {
                    $points += 3;
                } elseif ($score['is_draw'] == 1) {
                    $points += 1;
                }
            }
        }
        return ['points' => $points, 'goal_difference' => $goalDifference, 'total_score' => $totalScore];
    }

    /**
     * Rank the players
     * @param $results
     * @return array
     */
    private static function rankPlayers($results) {

        // We get the flattened scores
        $scores = self::flattenScores($results);

        // We add the points and total goal difference for each player
        array_walk($scores, function(&$value, $key) use($scores) {

            $points = self::calculatePlayerPoints($value['player_id'], $scores);

            $value['points'] = $points['points'];
            $value['total_goal_difference'] = $points['goal_difference'];
            $value['total_score'] = $points['total_score'];

        });

        // We rank the players
        self::rank($scores);

        // reset keys
        $scores = array_values($scores);

        $rankedPlayers = [];

        // We get unique players and assign a rank to them
        array_walk($scores, function(&$value, $key) use($scores, &$rankedPlayers) {

            // We check if it's a duplicate value
            $chunk = array_slice($scores, 0, $key);

            if (!Utils::searchMultiArrayByKeyReturnKeys($chunk, "player_id", $value['player_id'])) {
                $value['rank'] = sizeof($rankedPlayers) + 1;
                $rankedPlayers[] = $value;
            }
        });
        return $rankedPlayers;

    }

    /**
     * Rank the players
     *
     * @param $scores
     */
    private static function rank(&$scores) {

        // We rank the players first by rounds
        Utils::stableuasort($scores, function($a, $b) {

            // sort by points
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

        });
    }
}