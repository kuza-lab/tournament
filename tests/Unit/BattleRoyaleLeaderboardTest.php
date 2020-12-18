<?php

namespace Phelix\Tournaments\Tests\Unit;

use Phelix\Tournaments\Leaderboard\BattleRoyale;
use Phelix\Tournaments\Leaderboard\BattleRoyalePool;
use Phelix\Tournaments\Leaderboard\BattleRoyaleTournament;
use PHPUnit\Framework\TestCase;

class BattleRoyaleLeaderboardTest extends TestCase {


    /**
     * Set up the test case.
     */
    public function setUp(): void {
    }

    /**
     * Test for all balances
     */
    public function testRanking() {

        $results = [
            ["player_id" => "Mike", "position" => 1, "kills" => 20],
            ["player_id" => "Allan", "position" => 2, "kills" => 12],
            ["player_id" => "Daniel", "position" => 3, "kills" => 15],
            ["player_id" => "Sidney", "position" => 4, "kills" => 6],
            ["player_id" => "JP", "position" => 5, "kills" => 3],
        ];

        $response = BattleRoyale::generateStageLeaderboard($results);

        //print_r($response);

        $this->assertNotEmpty($response);
    }

    /**
     * test pool ranking
     */
    public function testPoolRanking() {

        $results = [
            [
                "group"     => 1,
                "matches"   => [
                    ["player_id" => "Mike", "position" => 1, "kills" => 20],
                    ["player_id" => "Allan", "position" => 2, "kills" => 12],
                    ["player_id" => "Daniel", "position" => 3, "kills" => 15],
                    ["player_id" => "Sidney", "position" => 4, "kills" => 6],
                    ["player_id" => "JP", "position" => 5, "kills" => 4],
                ]
            ],
            [
                "group"     => 2,
                "matches"   => [
                    ["player_id" => "Taru", "position" => 1, "kills" => 200],
                    ["player_id" => "Jordan", "position" => 2, "kills" => 120],
                    ["player_id" => "JP", "position" => 3, "kills" => 150],
                    ["player_id" => "Timothy", "position" => 4, "kills" => 60],
                    ["player_id" => "Calvin", "position" => 5, "kills" => 20],
                ]
            ]
        ];

        $response = BattleRoyalePool::generateStageLeaderboard($results);

        //print_r($response);

        $this->assertNotEmpty($response);
    }

    /**
     * test battle royale tournament (multi stage)
     */
    public function testMultiStageRanking() {

        $results = [

            [
                "stage" => 1,
                "type"  => "PBR",
                "rounds"    => [
                    [
                        "group"     => 1,
                        "matches"   => [
                            ["player_id" => "Mike", "position" => 1, "kills" => 20],
                            ["player_id" => "Allan", "position" => 2, "kills" => 12],
                            ["player_id" => "Daniel", "position" => 3, "kills" => 15],
                            ["player_id" => "Sidney", "position" => 4, "kills" => 6],
                            ["player_id" => "JP", "position" => 5, "kills" => 3],
                        ]
                    ],
                    [
                        "group"     => 2,
                        "matches"   => [
                            ["player_id" => "Taru", "position" => 1, "kills" => 200],
                            ["player_id" => "Jordan", "position" => 2, "kills" => 120],
                            ["player_id" => "Phelix", "position" => 3, "kills" => 150],
                            ["player_id" => "Timothy", "position" => 4, "kills" => 60],
                            ["player_id" => "Calvin", "position" => 5, "kills" => 30],
                        ]
                    ]
                ]
            ],
            [
                "stage" => 2,
                "type"  => "BR",
                "rounds"    => [
                    ["player_id" => "Mike", "position" => 1, "kills" => 345],
                    ["player_id" => "Allan", "position" => 2, "kills" => 235],
                    ["player_id" => "Taru", "position" => 3, "kills" => 79],
                    ["player_id" => "Jordan", "position" => 4, "kills" => 35]
                ]
            ]
        ];

        $response = BattleRoyaleTournament::generateStageLeaderboard($results);

        //print_r($response);

        $this->assertNotEmpty($response);
    }
}