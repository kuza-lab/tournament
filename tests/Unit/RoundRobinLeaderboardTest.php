<?php

namespace Phelix\Tournaments\Tests\Unit;

use Phelix\Tournaments\Leaderboard\RoundRobin;
use Phelix\Tournaments\Leaderboard\SingleElimination;
use PHPUnit\Framework\TestCase;

class RoundRobinLeaderboardTest extends TestCase {


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
            [
                "name" => "1.1",
                "scores" => [
                    ["player_id" => "Taru", "score" => 0],
                    ["player_id" => "Dan", "score" => 0],
                ]
            ],
            [
                "name" => "1.2",
                "scores" => [
                    ["player_id" => "Sykes", "score" => 2],
                    ["player_id" => "Phelix", "score" => 0],
                ]
            ],
            [
                "name" => "1.3",
                "scores" => [
                    ["player_id" => "Taru", "score" => 2],
                    ["player_id" => "Phelix", "score" => 2],
                ]
            ],
            [
                "name" => "1.4",
                "scores" => [
                    ["player_id" => "Dan", "score" => 2],
                    ["player_id" => "Sykes", "score" => 0],
                ]
            ],
            [
                "name" => "1.5",
                "scores" => [
                    ["player_id" => "Taru", "score" => 4],
                    ["player_id" => "Sykes", "score" => 5],
                ]
            ],
            [
                "name" => "1.6",
                "scores" => [
                    ["player_id" => "Phelix", "score" => 0],
                    ["player_id" => "Dan", "score" => 4],
                ]
            ]
        ];

        $response = RoundRobin::generateStageLeaderboard($results);

        //print_r($response);

        $this->assertNotEmpty($response);
    }
}