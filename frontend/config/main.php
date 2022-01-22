<?php
use yii\web\UrlNormalizer;
use yii\web\Request;

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);
$baseUrl = str_replace('/frontend/web', '', (new Request)->getBaseUrl());

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'assetManager' => [
            'bundles' => [
                /*'yii\web\JqueryAsset' => [
	                'sourcePath' => '@frontend/web/theme/plugins/jquery',
	                'js' => ['dist/jquery-3.5.1.min.js']
                ],*/
	            'yii\web\JqueryAsset' => [
		            'sourcePath' => null,
		            'js' => ['https://code.jquery.com/jquery-3.6.0.min.js'],
		            'jsOptions' => [
			            'integrity' => 'sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=',
			            'crossorigin' => 'anonymous'
		            ],
	            ],
                'yii\bootstrap\BootstrapPluginAsset' => [
	                'sourcePath' => '@frontend/web/theme/plugins/bootstrap5',
                    'js'=>[
                    	#'js/bootstrap.min.js',
                    	'js/bootstrap.bundle.min.js',
                    ]
                ],
                'yii\bootstrap\BootstrapAsset' => [
	                'sourcePath' => '@frontend/web/theme/plugins/bootstrap5',
                    'css' => [
                    	'css/bootstrap.min.css',
                    ]
                ]
            ]
        ],
        'urlManagerFrontend' => [
	        'class' => 'yii\web\urlManager',
	        'baseUrl' => $baseUrl.'/frontend/web/',
	        'enablePrettyUrl' => true,
	        'showScriptName' => false,
        ],
        'request' => [
            'baseUrl' => $baseUrl,
            'cookieValidationKey' => 'QkvfY7uwqQ6pDcfKdDkf',
            'csrfParam' => '_frontendCSRF',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => [
                'name' => '_frontendUser', // unique for frontend
            ]
        ],
        'session' => [
	        'class' => 'yii\web\Session',
            'name' => 'PHPFRONTSESSID',
            'savePath' => sys_get_temp_dir(),
            'timeout' => 3600,
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
            'baseUrl' => $baseUrl,
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            /*'normalizer' => [
	            'class' => 'yii\web\UrlNormalizer',
	            'action' => UrlNormalizer::ACTION_REDIRECT_TEMPORARY, // используем временный редирект вместо постоянного
	            'collapseSlashes' => false,
	            'normalizeTrailingSlash' => true,
            ],*/
            'rules' => array(
	            ['class' => 'frontend\components\UrlRules'],
                #'property/search' => 'property/search',
                'POST <controller:(compare)>/<slug:(get-property)>' => '<controller>/<action>',
                'GET <controller:(compare)>/<slug:.*?>' => '<controller>/index',
                'user/profile/<username>' => 'user/profile',
                'user/property/<username>' => 'user/property',
                'leads/status/<status>/<id>'=>'leads/status',
                'leads/delete/<id>'=>'leads/delete',
                'leads/detail/<id>' => 'leads/detail',
                'property/view/<id>' => 'property/view',
                'property/delete/<id>' => 'property/delete',
                'user/u/<user>' => 'user/u',
                'property/type/<id>' => 'property/type',
                'property/location/<id>' => 'property/location',
                'property/configuration/<id>' => 'property/configuration',
                'property/features/<id>' => 'property/features',
                'property/pricing/<id>' => 'property/pricing',
                'property/photos/<id>' => 'property/photos',
                #'saved/property/<ref>' => 'saved/property',
                #'saved/remove-property/<ref>' => 'saved/remove-property',
                #'saved/agents/<ref>' => 'saved/agents',
                #'saved/remove-agents/<ref>' => 'saved/remove-agents',
                '<user>/review' => 'user/review',
                'login'=> 'site/login',
                'my/saved/property' => 'my/property',
                'my/saved/agents' => 'my/agents',
                'my/listing' => 'my/listing',
                'tasks/complete/<id>'=>'tasks/complete',
                'tasks/delete/<id>'=>'tasks/delete',
                'contacts/edit/<id>'=>'contacts/edit',
                'contacts/delete/<id>'=>'contacts/delete',
                'groups/delete/<id>'=>'groups/delete',
                'groups/add-members/<group>'=>'groups/add-members',
                'groups/add-member/<group>/<id>'=>'groups/add-member',
                'groups/new/<group>/<id>'=>'groups/new',
                'groups/remove-member/<group>/<id>'=>'groups/remove-member',
                'notes/delete/<id>'=> 'notes/delete',
                'blog/detail/<id>/<title>'=> 'blog/detail',
                'blog/delete/<id>'=> 'blog/delete',
                'blog/edit/<id>'=> 'blog/edit',
                'blog/tag/<tag>'=> 'blog/tag',
                'search/city/<city>'=> 'search/city',
                'search/set/<city>'=> 'search/set',
                'mortgage/detail/<id>'=> 'mortgage/detail',
                'mortgage/disclaimer/<id>'=> 'mortgage/disclaimer',
                'mortgage/review/<id>'=> 'mortgage/review',
                'pages/index/<id>-<title>'=> 'pages/index',
            ),

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
        'Helpers' => [
	        'class' => 'common\components\Helpers',
        ],
    ],
    'modules' => [
        'newsletter' => [
            'class' => bl\newsletter\frontend\Newsletter::className()
        ]
    ],
    'params' => $params,
];
