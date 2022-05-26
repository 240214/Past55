<?php

namespace frontend\components;

use skeeks\yii2\assetsAuto\AssetsAutoCompressComponent;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\VarDumper;
use yii\web\View;

class AssetsAutoCompressCustomComponent extends AssetsAutoCompressComponent{
	
	public $jsFilesExclude = [];
	private $jsExcludedFiles = [];
	
	/**
	 * @param View $view
	 */
	protected function _processing(View $view){
		#VarDumper::dump($view->jsFiles, 10, 1);
		
		if(!empty($this->jsFilesExclude) && $view->jsFiles && $this->jsFileCompile){
			foreach($view->jsFiles as $pos => $files){
				$f_keys = array_keys($files);
				foreach($this->jsFilesExclude as $file){
					if(in_array($file, $f_keys)){
						$this->jsExcludedFiles[$file] = $view->jsFiles[$pos][$file];
						unset($view->jsFiles[$pos][$file]);
					}
				}
			}
		}
		
		#VarDumper::dump($this->jsExcludedFiles, 10, 1);
		
		parent::_processing($view);
	}
	
	protected function _processingJsFiles($files = []){
		#return parent::_processingJsFiles($files);
		
		$fileName  = md5(implode(array_keys($files)).$this->getSettingsHash()).'.js';
		$publicUrl = \Yii::$app->assetManager->baseUrl.'/js-compress/'.$fileName;
		//$publicUrl  = \Yii::getAlias('@web/assets/js-compress/' . $fileName);
		
		$rootDir = \Yii::$app->assetManager->basePath.'/js-compress';
		//$rootDir    = \Yii::getAlias('@webroot/assets/js-compress');
		$rootUrl = $rootDir.'/'.$fileName;
		
		if(file_exists($rootUrl)){
			$resultFiles = [];
			
			if(!$this->jsFileRemouteCompile){
				foreach($files as $fileCode => $fileTag){
					if(!Url::isRelative($fileCode)){
						$resultFiles[$fileCode] = $fileTag;
					}
				}
				if(!empty($this->jsExcludedFiles)){
					foreach($this->jsExcludedFiles as $fileCode=> $fileTag){
						if(Url::isRelative($fileCode)){
							$resultFiles[$fileCode] = $fileTag;
						}
					}
				}
			}
			
			$publicUrl = $publicUrl."?v=".filemtime($rootUrl);
			$resultFiles[$publicUrl] = Html::jsFile($publicUrl, $this->jsOptions);
			
			$resultFiles = $this->sortJsFiles($resultFiles);
			
			#VarDumper::dump($resultFiles, 10, 1);
			return $resultFiles;
		}
		
		//Reading the contents of the files
		try{
			$resultContent = [];
			$resultFiles   = [];
			foreach($files as $fileCode => $fileTag){
				if(Url::isRelative($fileCode)){
					if($pos = strpos($fileCode, "?")){
						$fileCode = substr($fileCode, 0, $pos);
					}
					
					$fileCode    = $this->webroot.$fileCode;
					$contentFile = $this->readLocalFile($fileCode);
					
					/**\Yii::info("file: " . \Yii::getAlias(\Yii::$app->assetManager->basePath . $fileCode), self::class);*/ //$contentFile = $this->fileGetContents( Url::to(\Yii::getAlias($tmpFileCode), true) );
					//$contentFile = $this->fileGetContents( \Yii::$app->assetManager->basePath . $fileCode );
					$resultContent[] = trim($contentFile)."\n;";;
				}else{
					if($this->jsFileRemouteCompile){
						//Try to download the deleted file
						$contentFile     = $this->fileGetContents($fileCode);
						$resultContent[] = trim($contentFile);
					}else{
						$resultFiles[$fileCode] = $fileTag;
					}
				}
			}
			if(!empty($this->jsExcludedFiles)){
				foreach($this->jsExcludedFiles as $fileCode=> $fileTag){
					if(Url::isRelative($fileCode)){
						$resultFiles[$fileCode] = $fileTag;
					}
				}
			}
		}catch(\Exception $e){
			\Yii::error(__METHOD__.": ".$e->getMessage(), static::class);
			
			return $files;
		}
		
		if($resultContent){
			$content = implode(";\n", $resultContent);
			if(!is_dir($rootDir)){
				if(!FileHelper::createDirectory($rootDir, 0777)){
					return $files;
				}
			}
			
			if($this->jsFileCompress){
				$content = \JShrink\Minifier::minify($content, ['flaggedComments' => $this->jsFileCompressFlaggedComments]);
			}
			
			$page        = \Yii::$app->request->absoluteUrl;
			$useFunction = function_exists('curl_init') ? 'curl extension' : 'php file_get_contents';
			$filesString = implode(', ', array_keys($files));
			
			\Yii::info("Create js file: {$publicUrl} from files: {$filesString} to use {$useFunction} on page '{$page}'", static::class);
			
			$file = fopen($rootUrl, "w");
			fwrite($file, $content);
			fclose($file);
		}
		
		
		if(file_exists($rootUrl)){
			$publicUrl               = $publicUrl."?v=".filemtime($rootUrl);
			$resultFiles[$publicUrl] = Html::jsFile($publicUrl, $this->jsOptions);
			
			$resultFiles = $this->sortJsFiles($resultFiles);
			
			return $resultFiles;
		}else{
			return $files;
		}
	}
	
	private function sortJsFiles($files){
		VarDumper::dump($files, 10, 1);
		
		foreach($files as $k => $file){
		
		}
		
		
		return $files;
	}
}
