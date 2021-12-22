<?php

namespace common\models\form;

use common\models\Leads;
use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
use yii\helpers\VarDumper;

define('IMG_SITE_DIR', \yii::getAlias('@frontend').'/web/images/site/logo/');

/**
 * ContactForm is the model behind the contact form.
 */
class SettingsForm extends Model {
	
	/**
	 * @var UploadedFile
	 */
	
	private $dynamicFields = [];
	private $dynamicRules = [];
	
	public function setDynamicFields($aryDynamics){
		$this->dynamicFields = $aryDynamics;
	}
	
	public function setDynamicRules($aryDynamics){
		$this->dynamicRules = $aryDynamics;
	}
	
	public function __get($name){
		if(isset($this->dynamicFields[$name])){
			return $this->dynamicFields[$name];
		}
		
		return parent::__get($name);
	}
	
	public function __set($name, $value){
		if(isset($this->dynamicFields[$name])){
			return $this->dynamicFields[$name] = $value;
		}
		
		return parent::__set($name, $value);
	}
	
	/**
	 * @inheritdoc
	 */
	public function rules(){
		return $this->dynamicRules;
	}
	
	
	/**
	 * @inheritdoc
	 */
	public function attributeLabels(){
		return [
			'site_name' => 'Site name',
			'site_title' => 'Site Title',
			'footer_description' => 'Footer description',
			'logo' => 'Logo',
			'address' => 'Address',
			'disclaimer' => 'Disclaimer',
			'layout' => 'Layout',
			'meta_keyword' => 'Meta keyword',
			'meta_description' => 'Meta description',
			'mobile' => 'Mobile',
			'email' => 'Email',
			'facebook' => 'Facebook',
			'twiter' => 'Twiter',
			'google' => 'Google',
			'header_top' => 'Header top',
			'header_main' => 'Header main',
		];
	}
	
	public function uploadLogo(){
		$name = rand(137, 999).time();
		$this->logo->saveAs(IMG_SITE_DIR.$name.'.'.$this->logo->extension);
		
		return $name.'.'.$this->logo->extension;
	}
	
}
