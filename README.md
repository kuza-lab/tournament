Tournament by Phelix Juma
================================================

This is a PHP package for tournament management 

Included Services 
=======================
- Ranking
   - Single Elimination
   - Double Elimination
   - Round Robin
   - Bracket Groups (round robin, single elimination and double elimination groups)
- Tournament Generator (coming soon...)
    

Installation
============

    composer require phelix/tournaments

How To test
===========

There are sample test cases shipped with the package. You can run the tests using the command below:

    vendor/bin/phpunit test


# Documentation

## 1. Ranking in a Round Robin

This is where all players play in a given round robin stage ie each player must play against each of the other opponents

```php

<?php 

    use Phelix\Tournaments\Leaderboard\RoundRobin;

    // Sample Results Data. Your data is to be passed to this method in this structure:
    $results = [
        [
            "name" => "1.1", // name of the match
            "scores" => [
                ["player_id" => "Taru", "score" => 0], // remember to use uid in player id and not the name as in this sample
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
    
    $ranks = RoundRobin::generateStageLeaderboard($results);
    
    // process the ranks as per your system needs.
    print_r($ranks);
```

## 1. Single Elimination

This is where players are in a single stage single elimination ie you lose and you're eliminated immediately

```php

<?php 

    use Phelix\Tournaments\Leaderboard\SingleElimination;
    
    // Expected data structure with sample
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

    $ranks = SingleElimination::generateStageLeaderboard($results);
    
    // process the ranks as per your system needs
    print_r($ranks);

    
```

## 3. Double Elimination

Use this where it's a single stage tournament ranking where players are in a DE ie lose twice to be eliminated

```php

<?php 

    use Phelix\Tournaments\Leaderboard\DoubleElimination;
    
    // Sample data showing the expected data structure
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

    $ranks = DoubleElimination::generateStageLeaderboard($results);

    // Process the ranks as per your system needs
    print_r($ranks);
    
```

## 4. Pool

Use this if, within a stage, players are put into different groups/pools eg Pool A, Pool B et al.

The pools can implement either a round robin, single elimination or double elimination bracket.

The data structure within a pool thus resembles the data structure for its bracket type so the structures already 
shown for each of the tournament types above would suffice

```php

<?php 

    use Phelix\Tournaments\Leaderboard\Pool;

    /**
     * This is sample data showing the data structure
     * This sample is for Round Robin Groups
     * As can be seen, the data structure for the "rounds" section resembles that one for round robin bracket shown above
     * You must modify this section depending on the group type eg for SE, you use the SE structure shown in the SE section above 
     */
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

    $ranks = Pool::generateStageLeaderboard($results);

    // Process the ranks
    print_r($ranks);
```

## 5. Multi Stage Tournament

Use this to generate an overall rank for an entire tournament

This can be used where players progress from one stage to the next 

Each stage can implement either of round robin, single elimination, double elimination or bracket groups. 
Because each stage is independent, it is possible to have different bracket types in each stage.

```php

<?php 
    
    use Phelix\Tournaments\Leaderboard\Tournament;

    // Sample data showing the expected data structure.
    // This sample is for stage 1 implementing single elimination after which the three winners
    // progress to stage 2 that implements round robin
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

    $ranks = Tournament::generateStageLeaderboard($results);

    // Process the ranks as per your system needs
    print_r($ranks);
```

Changelog
=========
- v1.0.0 First Release
- v1.0.1 Added a Fix to include draw points in round robin 

Credits
=======

- Phelix Juma from Kuza Lab Ltd (jumaphelix@kuzalab.com)
