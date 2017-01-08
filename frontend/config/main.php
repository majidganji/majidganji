<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'name' => 'مجید گنجی',
    'homeUrl' => '/majidganji',
    'language' => 'fa',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => 'aJjCAjfy71AJ4XOoSlqcK',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => 'WIWsUivVMJNeaZVMcjLz', 'httpOnly' => true],
        ],
        'session' => [
            'name' => 'ROVV3UPBDix0ZrFyl8oU',
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
        'errorHandler' => [
            'errorAction' => 'error/error',
        ],
        'request' => [
            'baseUrl' => '/majidganji'
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'archive/<month>' => 'site/archive',
                'search/<search>' => 'site/search',
                'work/<slug>' => 'site/workshow',
                '<action>/<slug>' => 'site/<action>',
                '' => 'site/index',
                '<action>' => 'site/<action>',
            ],
        ],
        'db' => [
            'enableSchemaCache' => true,
            'enableQueryCache' => true,
        ]
    ],
    'params' => $params,
];
