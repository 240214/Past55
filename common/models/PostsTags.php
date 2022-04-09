<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;


/**
 * This is the model class for table "blog_tags".
 * @property integer $id
 * @property string  $tag
 * @property string  $slug
 * @property integer  $post_id
 */
class PostsTags extends ActiveRecord {
	/**
	 * @inheritdoc
	 */
	public static function tableName(){
		return 'posts_tags';
	}
	
	public function getPosts(){
		return $this->hasOne(Posts::className(), ['post_id' => 'id']);
	}
	
	
	/**
	 * TODO
	 * @inheritdoc
	 */
	public static function addTag($tags, $post_id){
		$tagsExplod = explode(',', $tags);
		#var_dump($tagsExplod);
		
		foreach($tagsExplod as $tag){
			$check = static::IsUnique($tag);
			if($check){
				$tagModel       = new PostsTags();
				$tagModel->post_id = $post_id;
				$tagModel->save(false);
			}
			
		}
	}
	
	public function IsUnique($tags){
		$model = static::find()->where(['tag' => $tags]);
		
		$found = ($model->count() == 0) ? true : false;
		if($found){
			return true;
		}else{
			$tag       = $model->one();
			$tag->blog = $tag->blog + 1;
			$tag->save(false);
			
			return false;
		}
	}
	
}
