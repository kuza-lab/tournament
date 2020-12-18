<?php


/**
 * Tournament (multi stage) Leaderboard
 * @author Phelix Juma <jumaphelix@kuzalab.com>
 * @copyright (c) 2020, Kuza Lab
 * @package Kuzalab
 */

namespace Phelix\Tournaments\Leaderboard;


use Phelix\Tournaments\Utils;

final class Tournament {

    public static function generateStageLeaderboard($results) {
        return self::rankPlayers($results);
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

                $goalDifference += $score['total_goal_difference'];
                $totalScore += $score['total_score'];
                $points += $score['points'];
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
                case 'POOL':
                    $rankedStagePlayers = Pool::generateStageLeaderboard($stageResults);
                    break;
            }

            array_walk($rankedStagePlayers, function(&$value, $key) use($result) {
               $value['stage'] = $result['stage'];
            });

            $players = array_merge($players, $rankedStagePlayers);
        }

        // We add the points and total goal difference for each player
        array_walk($players, function(&$value, $key) use($players) {

            $points = self::calculatePlayerPoints($value['player_id'], $players);

            $value['points'] = $points['points'];
            $value['total_goal_difference'] = $points['goal_difference'];
            $value['total_score'] = $points['total_score'];

        });

        $kevin = Utils::searchMultiArrayByKey($players, "player_id", "Kevin");

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
            $value['tournament_rank'] = ++$key;
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

            // Rank by stage
            if ($a['stage'] == $b['stage']) {

                // same stage, rank by their original rank in that stage
                if ($a['rank'] == $a['rank']) {
                    return 0;
                } else {
                    return ($a['rank'] < $b['rank']) ? -1 : 1; // ascending order ranking
                }

            } else {
                return ($a['stage'] > $b['stage']) ? -1 : 1;
            }
        });
    }
}