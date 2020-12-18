<?php

namespace Phelix\Tournaments\Tests\Unit;

use Phelix\Tournaments\Leaderboard\DuelPool;
use PHPUnit\Framework\TestCase;

class DuelPoolLeaderboardTest extends TestCase {


    /**
     * Set up the test case.
     */
    public function setUp(): void {
    }

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

        $response = DuelPool::generateStageLeaderboard($results);

        //print_r($response);

        $this->assertNotEmpty($response);
    }

    public function testRanking2() {

        $results = [

            [
                "group"     => 1,
                "type"      => "RR",
                "rounds"    => [
                    [
                        "name" => "1.1",
                        "scores" => [
                            ["player_id" => "Ndirangu", "score" => 0],
                            ["player_id" => "Jolie", "score" => 0],
                        ]
                    ],
                    [
                        "name" => "1.2",
                        "scores" => [
                            ["player_id" => "Jolie", "score" => 2],
                            ["player_id" => "Joanna", "score" => 0],
                        ]
                    ],
                    [
                        "name" => "1.3",
                        "scores" => [
                            ["player_id" => "Ndirangu", "score" => 2],
                            ["player_id" => "Joanna", "score" => 3],
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
                            ["player_id" => "JP", "score" => 2],
                            ["player_id" => "Jane", "score" => 0],
                        ]
                    ],
                    [
                        "name" => "1.2",
                        "scores" => [
                            ["player_id" => "Jane", "score" => 2],
                            ["player_id" => "Aldo", "score" => 4],
                        ]
                    ],
                    [
                        "name" => "1.3",
                        "scores" => [
                            ["player_id" => "JP", "score" => 2],
                            ["player_id" => "Aldo", "score" => 1],
                        ]
                    ]
                ]
            ],
            [
                "group"     => 3,
                "type"      => "RR",
                "rounds"    => [
                    [
                        "name" => "1.1",
                        "scores" => [
                            ["player_id" => "Benjamin", "score" => 2],
                            ["player_id" => "Kilo", "score" => 2],
                        ]
                    ],
                    [
                        "name" => "1.2",
                        "scores" => [
                            ["player_id" => "Kilo", "score" => 0],
                            ["player_id" => "Antonio", "score" => 0],
                        ]
                    ],
                    [
                        "name" => "1.3",
                        "scores" => [
                            ["player_id" => "Benjamin", "score" => 1],
                            ["player_id" => "Antonio", "score" => 0],
                        ]
                    ]
                ]
            ],
            [
                "group"     => 4,
                "type"      => "RR",
                "rounds"    => [
                    [
                        "name" => "1.1",
                        "scores" => [
                            ["player_id" => "Michael", "score" => 2],
                            ["player_id" => "Jude", "score" => 0],
                        ]
                    ],
                    [
                        "name" => "1.2",
                        "scores" => [
                            ["player_id" => "Jude", "score" => 2],
                            ["player_id" => "Bernard", "score" => 4],
                        ]
                    ],
                    [
                        "name" => "1.3",
                        "scores" => [
                            ["player_id" => "Michael", "score" => 2],
                            ["player_id" => "Bernard", "score" => 0],
                        ]
                    ]
                ]
            ],
            [
                "group"     => 5,
                "type"      => "RR",
                "rounds"    => [
                    [
                        "name" => "1.1",
                        "scores" => [
                            ["player_id" => "Duncan", "score" => 2],
                            ["player_id" => "Kevin", "score" => 0],
                        ]
                    ],
                    [
                        "name" => "1.2",
                        "scores" => [
                            ["player_id" => "Kevin", "score" => 0],
                            ["player_id" => "Phelix", "score" => 4],
                        ]
                    ],
                    [
                        "name" => "1.3",
                        "scores" => [
                            ["player_id" => "Duncan", "score" => 3],
                            ["player_id" => "Phelix", "score" => 2],
                        ]
                    ]
                ]
            ],
            [
                "group"     => 6,
                "type"      => "RR",
                "rounds"    => [
                    [
                        "name" => "1.1",
                        "scores" => [
                            ["player_id" => "Sykes", "score" => 2],
                            ["player_id" => "Dan", "score" => 1],
                        ]
                    ],
                    [
                        "name" => "1.2",
                        "scores" => [
                            ["player_id" => "Dan", "score" => 2],
                            ["player_id" => "Jordan", "score" => 3],
                        ]
                    ],
                    [
                        "name" => "1.3",
                        "scores" => [
                            ["player_id" => "Sykes", "score" => 0],
                            ["player_id" => "Jordan", "score" => 0],
                        ]
                    ]
                ]
            ],
            [
                "group"     => 7,
                "type"      => "RR",
                "rounds"    => [
                    [
                        "name" => "1.1",
                        "scores" => [
                            ["player_id" => "Andrew", "score" => 3],
                            ["player_id" => "James", "score" => 0],
                        ]
                    ],
                    [
                        "name" => "1.2",
                        "scores" => [
                            ["player_id" => "James", "score" => 3],
                            ["player_id" => "Taru", "score" => 2],
                        ]
                    ],
                    [
                        "name" => "1.3",
                        "scores" => [
                            ["player_id" => "Andrew", "score" => 2],
                            ["player_id" => "Taru", "score" => 3],
                        ]
                    ]
                ]
            ],
            [
                "group"     => 8,
                "type"      => "RR",
                "rounds"    => [
                    [
                        "name" => "1.1",
                        "scores" => [
                            ["player_id" => "Timothy", "score" => 2],
                            ["player_id" => "Calvin", "score" => 0],
                        ]
                    ],
                    [
                        "name" => "1.2",
                        "scores" => [
                            ["player_id" => "Calvin", "score" => 3],
                            ["player_id" => "Earl", "score" => 2],
                        ]
                    ],
                    [
                        "name" => "1.3",
                        "scores" => [
                            ["player_id" => "Timothy", "score" => 1],
                            ["player_id" => "Earl", "score" => 2],
                        ]
                    ]
                ]
            ],

        ];

        $response = DuelPool::generateStageLeaderboard($results);

        //print_r($response);

        $this->assertNotEmpty($response);
    }
}