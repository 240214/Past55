<?php
use \yii\web\Request;
$baseUrl = str_replace('/backend/web', '', (new Request)->getBaseUrl());
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);
$params['tinymce'] = require(__DIR__ . '/tinymce.php');

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        // ...
        'newsletter' => [
            'class' => bl\newsletter\backend\Newsletter::className()
        ],
    ],
    'components' => [
        'user' => [
            'identityClass' => 'common\models\Admin',
            'enableAutoLogin' => true,
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'sourceLanguage' => 'en-EN',
                    'fileMap' => [
                        //'main' => 'main.php',
                    ],
                ],
            ],
        ],
        'urlManagerFrontend' => [
            'class' => 'yii\web\urlManager',
            'baseUrl' => $baseUrl.'/frontend/web/',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'urdJ3BbUEQ',
            'csrfParam' => '_backendCSRF',
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
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'location/form-state/<id>' => 'location/form-state',

                'property/formtype/<name>' => 'property/formtype',
                'property/cat/<name>' => 'property/cat',
                #'property/remove-image/<id>' => 'property/remove-image',
                #'property/ad-status/<id>/<status>' => 'property/ad-status',
                #'property/edit/<id>' => 'property/edit',

                #'mortgage/edit/<id>' => 'mortgage/edit',
                #'mortgage/delete/<id>' => 'mortgage/delete',

                #'pages/edit/<id>' => 'pages/edit',

                #'site/user-delete/<id>' => 'mortgage/delete',

                '<controller:[\w-]+>/<action:[\w-]+>/<id:\d+>/<status>' => '<controller>/<action>',
                '<controller:[\w-]+>/<action:[\w-]+>/<id:\d+>' => '<controller>/<action>',
                '<controller:[\w-]+>/<action:[\w-]+>' => '<controller>/<action>',
	


            ],
        ],
        'Helpers' => [
	        'class' => 'common\components\Helpers',
        ],
    ],
    'params' => $params,
];
