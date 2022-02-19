<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "blog_tags".
 * @property integer $id
 * @property string  $title
 * @property string  $slug
 */
class PostsCategories extends ActiveRecord {
	/**
	 * @inheritdoc
	 */
	public static function tableName(){
		return 'posts_categories';
	}
	
	
}
