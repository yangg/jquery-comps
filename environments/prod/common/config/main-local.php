<?php
return [
    'components' => [
        'db1' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=yii2advanced',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'sqlite:@backend/runtime/data.sqlite',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
        ],
    ],
];
