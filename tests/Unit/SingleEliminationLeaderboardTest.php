<?php

namespace Phelix\Tournaments\Tests\Unit;

use Phelix\Tournaments\Leaderboard\SingleElimination;
use PHPUnit\Framework\TestCase;

class SingleEliminationLeaderboardTest extends TestCase {


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
                "round" => 1,
                "matches" => [
                    [
                        "name" => "1.1",
                        "scores" => [
                            ["player_id" => "JP Omondi", "score" => 1],
                            ["player_id" => "Timothy Amahaya", "score" => 0],
                        ]
                    ],
                    [
                        "name" => "1.2",
                        "scores" => [
                            ["player_id" => "Taru", "score" => 2],
                            ["player_id" => "Phelix Juma", "score" => 0],
                        ]
                    ],
                    [
                        "name" => "1.3",
                        "scores" => [
                            ["player_id" => "Sykes", "score" => 3],
                            ["player_id" => "Joanna", "score" => 4],
                        ]
                    ],
                    [
                        "name" => "1.4",
                        "scores" => [
                            ["player_id" => "Calvin", "score" => 2],
                            ["player_id" => "Daniel", "score" => 5],
                        ]
                    ],
                    [
                        "name" => "1.5",
                        "scores" => [
                            ["player_id" => "Michael", "score" => 2],
                            ["player_id" => "Dan", "score" => 0],
                        ]
                    ],
                    [
                        "name" => "1.6",
                        "scores" => [
                            ["player_id" => "Sindani", "score" => 3],
                            ["player_id" => "Jordan", "score" => 2],
                        ]
                    ]
                ]
            ],
            [
                "round" => 2,
                "matches" => [
                    [
                        "name" => "2.1",
                        "scores" => [
                            ["player_id" => "JP Omondi", "score" => 2],
                            ["player_id" => "Joanna", "score" => 0],
                        ]
                    ],
                    [
                        "name" => "2.2",
                        "scores" => [
                            ["player_id" => "Michael", "score" => 0],
                            ["player_id" => "Daniel", "score" => 2],
                        ]
                    ],
                    [
                        "name" => "2.3",
                        "scores" => [
                            ["player_id" => "Sindani", "score" => 3],
                            ["player_id" => "Taru", "score" => 0],
                        ]
                    ]
                ]
            ]
        ];

        $response = SingleElimination::generateStageLeaderboard($results);

        //print_r($response);

        $this->assertNotEmpty($response);
    }
}