<?php

namespace common\models;

use Yii;
use yii\db\Query;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "blog comments".
 * @property integer $id
 * @property integer $post_id
 * @property integer $user_id
 * @property integer $likes
 * @property string  $comment
 * @property integer $created_at
 */
class PostsComments extends \yii\db\ActiveRecord{
	/**
	 * @inheritdoc
	 */
	public static function tableName(){
		return 'posts_comments';
	}
	
	/**
	 * @inheritdoc
	 */
	
	/**
	 * @inheritdoc
	 */
	public function rules(){
		return [
			['comment', 'required'],
			['comment', 'string'],
			[['post_id', 'likes', 'user_id', 'created_at'], 'safe']
		];
	}
	
	/**
	 * @inheritdoc
	 */
	public function attributeLabels(){
		return [
			'post_id' => Yii::t('app', 'Post ID'),
			'user_id' => Yii::t('app', 'User ID'),
			'comment' => Yii::t('app', 'Comment'),
			'likes'   => Yii::t('app', 'Likes'),
		];
	}
	
	public function getPosts(){
		return $this->hasOne(Posts::className(), ['post_id' => 'id']);
	}
	
	public static function countComment($id){
		return static::find()->where(['post_id' => $id])->count();
	}
	
}
