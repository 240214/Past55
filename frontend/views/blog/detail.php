<?php

use common\models\Users;

$this->title = $blog['blog_title'];
?>
<section class="section">
	<div class="container">
		<header class="section__title">
			<h2><?=$blog['blog_title']?></h2>
			<small>by <?=($blog['blog_author'] == "guest") ? $blog['author_name'] : " <b class='label label-default'>ADMIN</b> "?> on <?=date('d/M/Y', $blog['created_at']);?></small>
		</header>

		<div class="row">
			<div class="col-md-8 col-sm-7">
				<article class="card blog">
					<div class="card__img">
						<img src="<?=Yii::getAlias('@web');?>/images/blog/<?=$blog['blog_image'];?>" alt="">
					</div>
					<div class="card__body">
						<?=$blog['blog_body'];?>
					</div>

					<div class="blog__tags">
						<?php
						$tags = explode(',', $blog['blog_tags']);
						foreach($tags as $tag){
							echo '<a href="#" class="tags-list__item">#'.$tag.'</a>';
						}
						?>

					</div>

					<div class="blog__arthur">
						<div class="blog__arthur-img">
							<img src="<?=Yii::getAlias('@web');?>/images/user/<?=$blog['author_image'];?>" alt="">
						</div>
						<div class="blog__arthur-contents">
							<h2><?=$blog['blog_author'];?></h2>
							<p><?=Users::getAbout($blog['user_id']);?></p>

							<div class="blog__arthur-social">
								<a href="#" class="mdc-bg-indigo-500"><i class="zmdi zmdi-facebook"></i></a>
								<a href="#" class="mdc-bg-cyan-500"><i class="zmdi zmdi-twitter"></i></a>
								<a href="#" class="mdc-bg-red-400"><i class="zmdi zmdi-google"></i></a>
								<a href="#" class="mdc-bg-blue-600"><i class="zmdi zmdi-linkedin"></i></a>
							</div>
						</div>
					</div>
				</article>
			</div>
			
			<?=$this->render('_aside')?>
		</div>
	</div>
</section>
