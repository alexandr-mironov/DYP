<?php

return [
    'session' => [
        'class' => 'yii\web\DbSession',
        'db' => 'db',
        'name' => 'portal',
    ],
    'i18n' => [
        'translations' => [
            '*' => [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => '@app/messages'
            ],
        ],
    ],
    'db' => require __DIR__ . '/db.php',
    'mailer' => [
        'class' => 'yii\swiftmailer\Mailer',
        'transport' => [
            'class' => 'Swift_SmtpTransport',
            'host' => getenv('MAILER_HOST'),
            'username' => getenv('MAILER_USERNAME'),
            'password' => getenv('MAILER_PASSWORD'),
            'port' => getenv('MAILER_PORT'),
            'encryption' => getenv('MAILER_ENCRYPTION'),
        ],
    ],
    'queue' => [
        'class' => \yii\queue\db\Queue::class,
        'db' => 'db', // DB connection component or its config
        'tableName' => '{{%queue}}', // Table name
        'channel' => 'default', // Queue channel key
        'mutex' => \yii\mutex\PgsqlMutex::class, // Mutex used to sync queries
    ],

];