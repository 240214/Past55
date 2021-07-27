<?php

use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->title = "Blog";
?>


<section class="section">
	<div class="container">
		<header class="section__title">
			<h2>Blog from our comunity</h2>
			<small>Vestibulum id ligula porta felis euismod semper</small>
		</header>

		<div class="row">

			<div class="col-md-8 col-sm-7">
				<?php foreach($model as $blog): ?>
					<article class="card">
						<a class="card__img" href="<?=Url::toRoute('blog/detail/'.base64_encode($blog['id']).'/'.str_replace(' ', '+', $blog['blog_title']))?>">
							<img src="<?=Yii::getAlias('@web');?>/images/blog/<?=$blog['blog_image']?>" alt="">
						</a>
						<div class="card__header">
							<h2><?=$blog['blog_title'];?></h2>
							<small>by <?=($blog['blog_author'] == "guest") ? $blog['author_name'] : " <b class='label label-default'>ADMIN</b> "?> on <?=date('d/M/Y', $blog['created_at']);?></small>
						</div>
						<div class="card__body">
							<?=substr($blog['blog_body'], 0, 500)?>

							<div class="blog-more">
								<a href="<?=Url::toRoute('blog/detail/'.base64_encode($blog['id']).'/'.str_replace(' ', '+', $blog['blog_title']));?>">
									Read More...</a>
							</div>
						</div>
					</article>
				<?php endforeach; ?>
				<nav class="text-center">
					<?=LinkPager::widget(['pagination' => $pages]); //display pagination?>
				</nav>
			</div>
			<?=$this->render('_aside', ['model' => $model]);?>

		</div>
	</div>
</section>
