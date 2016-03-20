<?php

return [
    'modules' => [
        'noty' => [
            'class' => 'lo\modules\noty\Module',
            'defaultRoute' => 'noty/default/index'
        ],
    ],

    'components'=>[
        'urlManager'=>[
            'rules'=>[
                'noty' => 'noty/default/index',
            ]
        ]
    ]

];