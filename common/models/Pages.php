<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Pages model
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $template
 * @property string $meta_title
 * @property string $meta_description
 * @property integer $meta_noindex
 * @property integer $active
 */
class Pages extends ActiveRecord{
	
	
	public static function tableName(){
		return 'pages';
	}
	
	
	/**
	 * @inheritdoc
	 */
	public function rules(){
		return [
			[['title', 'slug'], 'required'],
			[['active', 'meta_noindex'], 'integer'],
			[['title', 'slug', 'content', 'template', 'meta_title', 'meta_description'], 'string'],
		
		];
	}
	
	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'title' => 'Title',
			'slug' => 'Slug',
			'active' => 'Active',
			'content' => 'Content',
			'template' => 'Template',
			'meta_title' => 'Meta Title',
			'meta_description' => 'Meta Description',
			'meta_noindex' => 'Noindex, Nofollow',
		];
	}
	
	
	public static function pageslist(){
		$model = Pages::find()->all();
		foreach($model as $list){
			?>
			<li>
				<a href="<?=\yii\helpers\Url::toRoute('title/'.$list['id'])?>"><?=$list['title']?></a>
			</li>
			<?php
		}
		
	}
	
}
