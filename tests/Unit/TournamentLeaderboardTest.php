<?php

namespace Phelix\Tournaments\Tests\Unit;

use Phelix\Tournaments\Leaderboard\Tournament;
use PHPUnit\Framework\TestCase;

class TournamentLeaderboardTest extends TestCase {


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
                "stage"     => 1,
                "type"      => "SE",
                "rounds"    => [

                    [
                        "round" => 1,
                        "matches" => [
                            [
                                "name" => "1.1",
                                "scores" => [
                                    ["player_id" => "Dan", "score" => 2],
                                    ["player_id" => "Kevin", "score" => 0],
                                ]
                            ],
                            [
                                "name" => "1.2",
                                "scores" => [
                                    ["player_id" => "Taru", "score" => 0],
                                    ["player_id" => "JP", "score" => 2],
                                ]
                            ],
                            [
                                "name" => "1.3",
                                "scores" => [
                                    ["player_id" => "Sykes", "score" => 1],
                                    ["player_id" => "Michael", "score" => 2],
                                ]
                            ],
                            [
                                "name" => "1.4",
                                "scores" => [
                                    ["player_id" => "Calvin", "score" => 2],
                                    ["player_id" => "Timothy", "score" => 3],
                                ]
                            ],
                            [
                                "name" => "1.5",
                                "scores" => [
                                    ["player_id" => "Jordan", "score" => 5],
                                    ["player_id" => "Aldo", "score" => 3],
                                ]
                            ],
                            [
                                "name" => "1.6",
                                "scores" => [
                                    ["player_id" => "Jude", "score" => 1],
                                    ["player_id" => "Phelix", "score" => 0],
                                ]
                            ]
                        ]
                    ],
                    [
                        "round"     => 2,
                        "matches"   => [
                            [
                                "name" => "2.1",
                                "scores" => [
                                    ["player_id" => "Timothy", "score" => 2],
                                    ["player_id" => "JP", "score" => 1],
                                ]
                            ],
                            [
                                "name" => "2.2",
                                "scores" => [
                                    ["player_id" => "Michael", "score" => 2],
                                    ["player_id" => "Dan", "score" => 0],
                                ]
                            ],
                            [
                                "name" => "2.3",
                                "scores" => [
                                    ["player_id" => "Jordan", "score" => 0],
                                    ["player_id" => "Jude", "score" => 3],
                                ]
                            ]
                        ]
                    ]

                ]
            ],
            [
                "stage"     => 2,
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
            ]
        ];

        $response = Tournament::generateStageLeaderboard($results);

        //print_r($response);

        $this->assertNotEmpty($response);
    }
}