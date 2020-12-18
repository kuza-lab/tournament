<?php


/**
 * Tournament (multi stage) for battle royale Leaderboard
 * @author Phelix Juma <jumaphelix@kuzalab.com>
 * @copyright (c) 2020, Kuza Lab
 * @package Kuzalab
 */

namespace Phelix\Tournaments\Leaderboard;


use Phelix\Tournaments\Utils;

final class BattleRoyaleTournament {

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

        $cumulative_points = 0;
        $cumulative_kill_points = 0;
        $cumulative_position_points = 0;

        foreach ($scores as $score) {
            if ($score['player_id'] == $playerId ) {

                $cumulative_kill_points += $score['kill_points'];
                $cumulative_points += $score['total_points'];
                $cumulative_position_points += $score['position_points'];
            }
        }
        return ['cumulative_kill_points' => $cumulative_kill_points, 'cumulative_position_points' => $cumulative_position_points, 'cumulative_points' => $cumulative_points];
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
                case 'BR':
                    $rankedStagePlayers = BattleRoyale::generateStageLeaderboard($stageResults);
                    break;
                case 'PBR':
                    $rankedStagePlayers = BattleRoyalePool::generateStageLeaderboard($stageResults);
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

            $value['cumulative_points'] = $points['cumulative_points'];
            $value['cumulative_kill_points'] = $points['cumulative_kill_points'];
            $value['cumulative_position_points'] = $points['cumulative_position_points'];

        });

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