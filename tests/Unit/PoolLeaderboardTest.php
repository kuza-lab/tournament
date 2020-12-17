<?php

namespace Phelix\Tournaments\Tests\Unit;

use Phelix\Tournaments\Leaderboard\Pool;
use PHPUnit\Framework\TestCase;

class PoolLeaderboardTest extends TestCase {


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
                "group"     => 1,
                "type"      => "RR",
                "rounds"    => [
                    [
                        "name" => "1.1",
                        "scores" => [
                            ["player_id" => "Timothy", "score" => 0],
                            ["player_id" => "Michael", "score" => 0],
                        ]
                    ],
                    [
                        "name" => "1.2",
                        "scores" => [
                            ["player_id" => "Timothy", "score" => 2],
                            ["player_id" => "Jude", "score" => 0],
                        ]
                    ],
                    [
                        "name" => "1.3",
                        "scores" => [
                            ["player_id" => "Michael", "score" => 2],
                            ["player_id" => "Jude", "score" => 3],
                        ]
                    ]
                ]
            ],
            [
                "group"     => 2,
                "type"      => "RR",
                "rounds"    => [
                    [
                        "name" => "1.1",
                        "scores" => [
                            ["player_id" => "Dan", "score" => 1],
                            ["player_id" => "Sindani", "score" => 1],
                        ]
                    ],
                    [
                        "name" => "1.2",
                        "scores" => [
                            ["player_id" => "Dan", "score" => 3],
                            ["player_id" => "JP", "score" => 0],
                        ]
                    ],
                    [
                        "name" => "1.3",
                        "scores" => [
                            ["player_id" => "Sindani", "score" => 4],
                            ["player_id" => "JP", "score" => 3],
                        ]
                    ]
                ]
            ]
        ];

        $response = Pool::generateStageLeaderboard($results);

        //print_r($response);

        $this->assertNotEmpty($response);
    }
}