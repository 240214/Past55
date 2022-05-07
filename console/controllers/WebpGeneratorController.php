<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;
use common\components\Helpers;

class WebpGeneratorController extends Controller {
	
	private $webp_quality = 20;
	private $convertor = null;
	private $convert_limit = 10;
	private $converted_count = 0;
	private $allow_extensions = ['jpg', 'jpeg', 'png'];
	private $scan_paths = [
		'@frontend/web/images',
		'@frontend/web/uploads',
		'@frontend/web/uploads_thumbs',
		'@frontend/web/theme/img/about',
		'@frontend/web/theme/img/authors',
		'@frontend/web/theme/img/careers',
		'@frontend/web/theme/img/category',
		'@frontend/web/theme/img/contact-us',
		'@frontend/web/theme/img/home',
	];
	private $files = [];
	
	public function actionBegin(){
		Yii::info('Begin WebP generate', 'cron');
		
		$this->convertor = new Helpers();
		
		foreach($this->scan_paths as $path){
			if($this->converted_count >= $this->convert_limit) continue;

			$this->convertImageFiles($path);
		}
		
		Yii::info('End WebP generate', 'cron');
		Yii::info('--------------------------------------------------------------------', 'cron');
	}
	
	private function convertImageFiles($path){
		$path = Yii::getAlias($path);
		
		$this->findNotConvertedImageFiles($path);
		
		Yii::info(sprintf('Total files count: %d', count($this->files)), 'cron');
		
		if(!empty($this->files)){
			$files = array_slice($this->files, 0, $this->convert_limit);
			Yii::info(sprintf('Preparing %d files', count($files)), 'cron');
			
			foreach($files as $name => $path){
				Yii::info(sprintf('Converting file: %s', $path), 'cron');
				$result = $this->convertor->convertToWebp($name, $path, $this->webp_quality);
				if(!is_null($result)){
					Yii::info(sprintf('Converted file: %s', $result), 'cron');
					$this->converted_count++;
				}
			}
			
			Yii::info(sprintf('Converted %d files', $this->converted_count), 'cron');
		}
	}
	
	private function findNotConvertedImageFiles($path){
		$list = array_diff(scandir($path), ['..', '.']);
		
		if(!empty($list)){
			foreach($list as $item){
				if(is_dir($path.DIRECTORY_SEPARATOR.$item)){
					$this->findNotConvertedImageFiles($path.DIRECTORY_SEPARATOR.$item);
				}else{
					$pathinfo = pathinfo($path.DIRECTORY_SEPARATOR.$item);
					if(in_array($pathinfo['extension'], $this->allow_extensions)){
						$webp_file = sprintf('%s%s%s%s', $pathinfo['dirname'], DIRECTORY_SEPARATOR, $pathinfo['filename'], '.webp');
						if(!file_exists($webp_file)){
							$this->files[$pathinfo['basename']] = $path.DIRECTORY_SEPARATOR.$item;
						}
					}
				}
			}
		}
		
	}
}
