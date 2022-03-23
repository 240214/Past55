<?php

namespace frontend\widgets;

use common\models\Posts;
use Yii;
use yii\bootstrap\Widget;
use yii\helpers\VarDumper;

class PostContentList extends Widget{
	
	public $model = null;
	public $title = 'Content';
	public $post_id = 0;
	private $content_list = [];
	
	public function init(){
		parent::init();
		
		if(is_null($this->model) && $this->post_id != 0){
			$this->model = Posts::find()->select(['content_list'])->where(['id' => $this->post_id])->one();
		}
		if(!is_null($this->model)){
			if(!empty($this->model->content_list)){
				$list_arr = explode(PHP_EOL, $this->model->content_list);
				if(is_array($list_arr)){
					foreach($list_arr as $item){
						if(!empty($item)){
							$a = explode('|', $item);
							$this->content_list[$a[0]] = $a[1];
						}
					}
				}
			}
		}
		
		
		#VarDumper::dump($this->model, 10, 1);exit;
	}
	
	public function run(){
		return $this->render('@frontend/views/widgets/post-content-list', [
			'content_list' => $this->content_list,
			'title' => $this->title,
		]);
	}
	
}
