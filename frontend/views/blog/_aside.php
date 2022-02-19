<?php

use bl\newsletter\frontend\widgets\Subscribe;
use common\models\Posts;
use common\models\BlogTags;
use common\models\BlogComment;
use common\models\Users;
use yii\helpers\Url;

$recentBlog     = Posts::find()->limit(4)->orderBy(['id' => SORT_DESC])->all();
$tags           = BlogTags::find()->limit(20)->orderBy(['blog' => SORT_DESC])->all();
$recentComments = BlogComment::find()->limit(4)->orderBy(['id' => SORT_DESC])->all();

?>
<aside class="col-md-4 col-sm-5 d-none d-sm-block">
	<div class="card">
		<div class="card__header">
			<h2>Recent articles</h2>
			<small>Morbi risus porta consectetur vestibulum</small>
		</div>

		<div class="list-group">
			<?php foreach($recentBlog as $blog):?>
				<a href="<?=Url::toRoute('blog/detail/'.base64_encode($blog['id']).'/'.str_replace(' ', '+', $blog['blog_title']))?>" class="list-group-item media">
					<div class="pull-left">
						<img src="<?=Yii::getAlias('@web')?>/images/blog/<?=$blog['blog_image']?>" alt="" class="list-group__img" width="65">
					</div>
					<div class="media-body list-group__text">
						<strong><?=$blog['blog_title']?></strong>
						<small>
							<?=substr($blog['blog_body'], 0, 50)?>
						</small>
					</div>
				</a>
			<?php endforeach;?>

			<div class="p-10"></div>
		</div>
	</div>
</aside>
