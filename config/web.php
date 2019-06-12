<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'g51xmqX7xf2Y_tl-4O9JfrWJT11YGXAr',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/not-found',
        ],
        'response' => [
            'formatters' => [
                'pdf' => [
                    'class' => 'robregonm\pdf\PdfResponseFormatter',
                ],
            ]
        ],
        'authClientCollection' => [
  'class' => 'yii\authclient\Collection',
  'clients' => [
    'facebook' => [
      'class' => 'yii\authclient\clients\Facebook',
      'authUrl' => "https://www.facebook.com/dialog/oauth?=popup",
      'clientId' => '1041243415987827',
      'clientSecret' => '944e804c321b65f5b91180ceb7eaf20b',
      'attributeNames' => ['name', 'email', 'first_name', 'last_name'],
    ],
  ],
],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
               
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'login' => 'site/login',
                'logout' => 'site/logout',
                'contact' => 'site/contact',
                'about' => 'site/about',
                'page' => 'search/page',
                'admin/pages' => 'pages/index',
                '<controller:\w+>/<action:\w+>/<id:\w+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ],
        ],
		'cm' => [
            'class' => 'app\components\CashMoney',
            'client_id' => 'AQL4UkCSnceW6c753QVyaOY5gmDHmt6m0Dna6iInqslVybEKttVfxnsK6B3TbjQFb-OeQrs0arF4RtfF',
            'client_secret' => 'EK-TEXsVki0RR_2dlIin9w5unlNy_foKYLukf9KD01SwXzgYgL6X-a4a51v4jqC9ee1gjtrERC19GjP_',
        ],
		 'db' => require(__DIR__ . '/db.php'),
        
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['112.196.5.114'],
    ];
}

return $config;
