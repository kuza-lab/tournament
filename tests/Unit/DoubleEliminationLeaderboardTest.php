<?php

namespace Phelix\Tournaments\Tests\Unit;

use Phelix\Tournaments\Leaderboard\DoubleElimination;
use PHPUnit\Framework\TestCase;

class DoubleEliminationLeaderboardTest extends TestCase
{


    /**
     * Set up the test case.
     */
    public function setUp(): void
    {
    }

    /**
     * Test for all balances
     */
    public function testRanking()
    {

        $results = [

            [
                "bracket"   => "WB",
                "rounds"    => [
                    [

                        "round" => 1,
                        "matches" => [
                            [
                                "name" => "1.1",
                                "scores" => [
                                    ["player_id" => "Dan", "score" => 2],
                                    ["player_id" => "Taru", "score" => 0],
                                ]
                            ],
                            [
                                "name" => "1.2",
                                "scores" => [
                                    ["player_id" => "Michael", "score" => 1],
                                    ["player_id" => "JP", "score" => 0],
                                ]
                            ],
                            [
                                "name" => "1.3",
                                "scores" => [
                                    ["player_id" => "Phelix", "score" => 0],
                                    ["player_id" => "Sykes", "score" => 2],
                                ]
                            ],
                            [
                                "name" => "1.4",
                                "scores" => [
                                    ["player_id" => "Calvin", "score" => 1],
                                    ["player_id" => "Jordan", "score" => 4],
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
                                    ["player_id" => "Jordan", "score" => 2],
                                    ["player_id" => "Sykes", "score" => 1],
                                ]
                            ],
                            [
                                "name" => "2.2",
                                "scores" => [
                                    ["player_id" => "Michael", "score" => 0],
                                    ["player_id" => "Dan", "score" => 5],
                                ]
                            ]
                        ]
                    ],
                    [
                        "round" => 3,
                        "matches" => [
                            [
                                "name" => "3.1",
                                "scores" => [
                                    ["player_id" => "Dan", "score" => 1],
                                    ["player_id" => "Jordan", "score" => 0],
                                ]
                            ]
                        ]
                    ],
                    [
                        "round" => 4,
                        "matches" => [
                            [
                                "name" => "4.1",
                                "scores" => [
                                    ["player_id" => "Dan", "score" => 2],
                                    ["player_id" => "Phelix", "score" => 4],
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            [
                "bracket"   => "LB",
                "rounds"    => [

                    [

                        "round" => 1,
                        "matches" => [
                            [
                                "name" => "1.1L",
                                "scores" => [
                                    ["player_id" => "Phelix", "score" => 1],
                                    ["player_id" => "Taru", "score" => 0],
                                ]
                            ],
                            [
                                "name" => "1.2L",
                                "scores" => [
                                    ["player_id" => "JP", "score" => 2],
                                    ["player_id" => "Calvin", "score" => 0],
                                ]
                            ]
                        ]
                    ],
                    [
                        "round" => 2,
                        "matches" => [
                            [
                                "name" => "2.1L",
                                "scores" => [
                                    ["player_id" => "Sykes", "score" => 2],
                                    ["player_id" => "Phelix", "score" => 3],
                                ]
                            ],
                            [
                                "name" => "2.2L",
                                "scores" => [
                                    ["player_id" => "Michael", "score" => 2],
                                    ["player_id" => "JP", "score" => 0],
                                ]
                            ]
                        ]
                    ],
                    [
                        "round" => 3,
                        "matches" => [
                            [
                                "name" => "3.1L",
                                "scores" => [
                                    ["player_id" => "Phelix", "score" => 2],
                                    ["player_id" => "Michael", "score" => 0],
                                ]
                            ]
                        ]
                    ],
                    [
                        "round" => 4,
                        "matches" => [
                            [
                                "name" => "4.1L",
                                "scores" => [
                                    ["player_id" => "Jordan", "score" => 2],
                                    ["player_id" => "Phelix", "score" => 3],
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $response = DoubleElimination::generateStageLeaderboard($results);

        //print_r($response);

        $this->assertNotEmpty($response);
    }
}