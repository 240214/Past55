<?php


namespace frontend\widgets;

use common\models\Pages;
use Yii;
use yii\bootstrap\Widget;
use frontend\assets\AppAsset;
use yii\bootstrap\BootstrapAsset;
use common\models\Users;

class PostAuthor extends Widget{
	
	public $user;
	public $wrapper_attrs = [];
	
	public function init(){
		parent::init();
		
		if(!$this->user instanceof Users && is_numeric($this->user)){
			$this->user = Users::find()->where(['id' => $this->user])->one();
		}
		
		$default_attrs = [
			'id'    => 'js_post_author',
			'class' => 'post-author',
		];
		
		$this->wrapper_attrs = array_merge($default_attrs, $this->wrapper_attrs);
		
		$this->view->registerCssFile('@web/theme/css/widgets/post-author.css', ['depends' => [BootstrapAsset::className(), AppAsset::className()]]);
	}
	
	public function run(){
		return $this->render('@frontend/views/widgets/post-author', [
			'wrapper_attrs' => Yii::$app->Helpers->create_html_attributes($this->wrapper_attrs),
			'name'          => $this->user->name,
			'position'      => $this->user->position,
			'about'         => $this->user->about,
			'avatar'        => $this->user->FormatedAvatar,
			'social_links'  => $this->user->SocialLinks,
		]);
	}
	
	private function create_html_attributes(){
		$compiled = implode('="%s" ', array_keys($this->wrapper_attrs)).'="%s"';
		
		return vsprintf($compiled, array_map('htmlspecialchars', array_values($this->wrapper_attrs)));
	}
	
}
