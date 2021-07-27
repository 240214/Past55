<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "blog_tags".
 * @property integer $id
 * @property string $user_id
 * @property string $keywords
 * @property string $type
 * @property string $property_of
 * @property string $list_for
 * @property string $price_min
 * @property string $price_max
 * @property string $bedrooms
 * @property string $bathrooms
 * @property string $search_time
 */
class MySearch extends \yii\db\ActiveRecord{
	/**
	 * @inheritdoc
	 */
	public static function tableName(){
		return 'my_search';
	}
	
	/**
	 * @inheritdoc
	 */
	public function rules(){
		return [
			[['keywords', 'type', 'property_of', 'list_for', 'price_min', 'price_max', 'bedrooms', 'bathrooms'], 'safe'],
		
		];
	}
	
	
	/**
	 * @inheritdoc
	 */
	
	public static function add($keyword){
		$uid = Yii::$app->user->identity->getId();
		
		$model              = new MySearch();
		$model->user_id     = $uid;
		$model->keywords    = $keyword->input;
		$model->type        = ($keyword->type) ? $keyword->type : "commercial";
		$model->property_of = ($keyword->ownership) ? $keyword->ownership : "owner";
		$model->list_for    = ($keyword->listfor) ? $keyword->listfor : "rent";
		$model->price_min   = ($keyword->priceMin) ? $keyword->priceMin : "0";
		$model->price_max   = ($keyword->priceMax) ? $keyword->priceMax : "0";;
		
		$model->bedrooms  = ($keyword->bedroom) ? $keyword->bedroom : "0";
		$model->bathrooms = ($keyword->bathroom) ? $keyword->bathroom : "0";;
		
		
		$model->search_time = time();
		$model->save(false);
	}
	
}
