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
			'instagram' => 'Instagram',
			'linkedin' => 'LinkedIn',
			'google' => 'Google',
			'header_top' => 'Header top',
			'header_main' => 'Header main',
			'office_time' => 'Office time',
			'category_page_display_listing_item_price' => 'Display listing item price in category page',
			'category_page_display_listing_item_description' => 'Display listing item description in category page',
			'category_page_display_listing_item_rating' => 'Display listing item rating in category page',
			'min_listings_count_in_category_page' => 'Min listings count in category page',
		];
	}
	
	public function uploadLogo(){
		$name = rand(137, 999).time();
		$this->logo->saveAs(IMG_SITE_DIR.$name.'.'.$this->logo->extension);
		
		return $name.'.'.$this->logo->extension;
	}
	
}
