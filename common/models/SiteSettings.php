<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * SiteSettings model
 * @property integer $id
 * @property string $site_name
 * @property string $site_title
 * @property string $logo
 * @property string $address
 * @property string $disclaimer
 * @property string $layout
 * @property string $min_withdrawal_balance
 * @property string $meta_keyword
 * @property string $meta_description
 * @property string $mobile
 * @property string $email
 * @property string $facebook
 * @property string $twiter
 * @property string $google
 */


if(!defined('IMG_SITE_DIR')){
	define('IMG_SITE_DIR', \yii::getAlias('@frontend').'/web/images/site/logo/');
}

class SiteSettings extends ActiveRecord{
	
	public $header_top = false;
	public $header_main = true;
	
	/**
	 * @var UploadedFile
	 */
	
	public static function tableName(){
		return 'site_settings';
	}
	
	
	/**
	 * @inheritdoc
	 */
	public function rules(){
		return [
			[['logo'], 'file', 'extensions' => ['jpg', ' png'], 'checkExtensionByMimeType' => false],
			
			[['logo', 'site_title', 'layout', 'site_name', 'meta_keyword', 'meta_description'], 'safe'],
			[['mobile', 'email', 'google', 'facebook', 'twiter'], 'required'],
		
		
		];
	}
	
	public function attributeLabels(){
		return [
			'mobile'   => Yii::t('app', 'Contact Number'),
			'email'    => Yii::t('app', 'Contact Email Address'),
			'facebook' => Yii::t('app', 'Site Facebook Link'),
			'twiter'   => Yii::t('app', 'Site Twitter Link'),
			'google'   => Yii::t('app', 'Site Google+ Link'),
		
		];
	}
	
	
	public static function logo(){
		$pic = static::find()->one();
		$pic->logo;
		
		return $pic->logo;
	}
	
	
	public function uploadLogo(){
		$name = rand(137, 999).time();
		$this->logo->saveAs(IMG_SITE_DIR.$name.'.'.$this->logo->extension);
		
		return $name.'.'.$this->logo->extension;
	}
	
	public static function setLayout($layout){
		//        //echo $layout;die;
		//        $path = Yii::$app->basePath."/web/text/";
		//        $file = $path.'layout.txt';
		//        //$uniq = file_get_contents($file);
		//
		//        file_put_contents($file, $layout);
		
		return true;
	}
	
	public static function getLayout(){
		$back   = Yii::getAlias('@backend');
		$path   = $back."/web/text/";
		$file   = $path.'layout.txt';
		$layout = file_get_contents($file);
		
		// file_put_contents($file, $layout);
		
		return $layout;
	}
	
	
}
