<?php

return [
    'credit' => [
        'topic_published' => 10,
        'post_published' => 2,
        'post_like' => 1,
        'best_post_awarded' => 15,
        'post_favorited' => 5,
    ],
    'allowed_reputation' => [
        'admin' => range(-5, 5),
        'moderator' => range(-5, 5),
        'upg2' => range(-3, 3),
        'upg1' => range(-1, 1),
        'default' => [0],
    ],
    'pagination' => [
        'perPage' => 5,
    ],
];
