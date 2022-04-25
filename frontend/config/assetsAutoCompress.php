<?php
use yii\helpers\VarDumper;

$enabled = true;

if(YII_ENV_DEV){
	$enabled = false;
}else{
	if(!empty($_SERVER['REQUEST_URI'])){
		if(
			stristr($_SERVER['REQUEST_URI'], '/admin/') !== false ||
			stristr($_SERVER['REQUEST_URI'], 'create') !== false ||
			stristr($_SERVER['REQUEST_URI'], 'update') !== false ||
			stristr($_SERVER['REQUEST_URI'], 'delete') !== false
		){
			$enabled = false;
		}else{
			preg_match('/\d+/', $_SERVER['REQUEST_URI'], $output);
			if(!empty($output) && count($output) > 0 && is_numeric($output[0])){
				$enabled = false;
			}
		}
		#VarDumper::dump($enabled, 1, 1);
	}
}

return [
	'class'   => '\skeeks\yii2\assetsAuto\AssetsAutoCompressComponent',
	'enabled' => $enabled,

	'readFileTimeout' => 3,           //Time in seconds for reading each asset file

	'jsCompress'                => true,        //Enable minification js in html code
	'jsCompressFlaggedComments' => true,        //Cut comments during processing js

	'cssCompress' => true,        //Enable minification css in html code

	'cssFileCompile'        => true,        //Turning association css files
	'cssFileRemouteCompile' => true,       //Trying to get css files to which the specified path as the remote file, skchat him to her.
	'cssFileCompress'       => true,        //Enable compression and processing before being stored in the css file
	'cssFileBottom'         => false,       //Moving down the page css files
	'cssFileBottomLoadOnJs' => false,       //Transfer css file down the page and uploading them using js

	'jsFileCompile'                 => true,        //Turning association js files
	'jsFileRemouteCompile'          => true,       //Trying to get a js files to which the specified path as the remote file, skchat him to her.
	'jsFileCompress'                => true,        //Enable compression and processing js before saving a file
	'jsFileCompressFlaggedComments' => true,        //Cut comments during processing js

	'noIncludeJsFilesOnPjax' => true,        //Do not connect the js files when all pjax requests

	'htmlFormatter' => [
		//Enable compression html
		'class'         => 'skeeks\yii2\assetsAuto\formatters\html\TylerHtmlCompressor',
		'extra'         => true,       //use more compact algorithm
		'noComments'    => true,        //cut all the html comments
		'maxNumberRows' => 50000,       //The maximum number of rows that the formatter runs on

		//or

		//'class' => 'skeeks\yii2\assetsAuto\formatters\html\MrclayHtmlCompressor',

		//or any other your handler implements skeeks\yii2\assetsAuto\IFormatter interface

		//or false
	],
];