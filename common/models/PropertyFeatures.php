<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "property_features".
 * @property integer $id
 * @property string $name
 * @property integer $feature_type_id
 * @property string $image
 * @property integer $value
 */
class PropertyFeatures extends ActiveRecord{
	
	public $feature_type;
	
	/**
	 * @inheritdoc
	 */
	public static function tableName(){
		return 'property_features';
	}
	
	/**
	 * @inheritdoc
	 */
	public function rules(){
		return [
			[['name'], 'required'],
			[['value', 'feature_type_id'], 'integer'],
			[['name', 'image'], 'string', 'max' => 225],
			[['image'], 'string'],
		];
	}
	
	/**
	 * @inheritdoc
	 */
	public function attributeLabels(){
		return [
			'id'              => Yii::t('app', 'ID'),
			'name'            => Yii::t('app', 'Name'),
			'image'           => Yii::t('app', 'Icon'),
			'value'           => Yii::t('app', 'Value'),
			'feature_type_id' => Yii::t('app', 'Feature type'),
		];
	}
	
	public function afterFind(){
		if($this->feature_type_id){
			$this->feature_type = $this->getFeatureType();
		}
	}
	
	public function getFeatureType(){
		if(!$this->feature_type_id)
			return '';
		
		$model = PropertyFeaturesTypes::find()->where(['id' => $this->feature_type_id])->one();
		
		return $model->title;
	}
	
	public static function displayList($data){
		if($data){
			$data = explode(",", $data);
			
			foreach($data as $feature){
				$model    = static::findOne($feature);
				$features = $model->name;
				$icon     = $model->image;
				echo "<li>".$features."</li>";
				
			}
		}else{
			?>
			<blockquote style="border-color: #99d962">
				No Features and specification describe by Agent
			</blockquote>
			<?php
		}
		
	}
	
	public static function displayGrid($data){
		if($data){
			$data = explode(",", $data);
			
			foreach($data as $feature){
				$array   = array('mdc-bg-light-green-500', 'mdc-bg-brown-400', 'mdc-bg-blue-grey-400', 'mdc-bg-red-300', 'mdc-bg-purple-300', 'mdc-bg-pink-300', 'mdc-bg-light-blue-500', 'mdc-bg-amber-400', 'mdc-bg-teal-400');
				$classes = array_rand($array, 9);
				$key     = rand(1, 8);
				$class   = $array[$classes[$key]];
				
				$model    = static::findOne($feature);
				$features = $model->name;
				$icon     = $model->image;
				echo "<li class='$class'> <i class='$icon'></i>".$features."</li>";
				// echo "<div class='col-lg-3 truncate' align='center' title='$features'> <h4><span class='$icon'></span></h4>".."</div>";
				
			}
			
		}else{
			?>
			<blockquote style="border-color: #99d962">
				No Amenities in this house/plot
			</blockquote>
			<?php
		}
		
	}
	
	public static function displayPageList($data){
		$data = explode(",", $data);
		
		foreach($data as $feature){
			$model = static::findOne($feature);
			if($model){
				$features = $model->name;
				$icon     = $model->image;
				echo "<span class='bedrooms' data-toggle='tooltip' title='$features' >";
				echo " <i class='$icon'></i> ".$features;
				echo "</span>";
			}
			
			
		}
		
	}
	
}
