<?php use frontend\widgets\Image;
use yii\helpers\Url;?>
<?php if($found):?>
	<div class="posts-carousel">
		<?php if(!empty($head['title'])):?>
			<div class="d-flex justify-content-between mb-2 mb-md-3">
				<h3 class="category-title"><a href="<?=$head['link'];?>"><?=$head['title'];?></a></h3>
				<?php if($display_see_all_link):?>
				<a class="see-all-link d-none d-md-block text-decoration-underline" href="<?=$head['link'];?>">See All</a>
				<?php endif;?>
			</div>
		<?php endif;?>
		<div class="js_posts_carousel mb-2 mb-md-6 <?=$display_nav_arrows;?>">
			<?php foreach($dataProvider->getModels() as $model):?>
				<?php $url = Url::toRoute(['post/view', 'post_slug' => $model->slug, 'category_slug' => $model->postsCategories->slug]);?>
					<div class="cardbox bg-white">
						<figure class="image empty-bg mb-1">
							<?=Image::widget([
								'src'         => $model->getMainImage('575'),
								'data_srcset' => $model->getMainImage('575').' 575w, '.$model->getMainImage('767').' 767w, '.$model->getMainImage('575').' 768w',
								'data_sizes'  => '575w',
								'alt'         => $model->title,
								'from_cdn'    => false,
								'lazyload'    => false,
								'css_class'   => 'img-fluid',
							]);?>
						</figure>
						<div class="p-15 p-md-25">
							<?php if($display_post_type):?>
							<div class="post-type"><?=($model->type == 'post' ? 'Blog Post' : 'Article');?></div>
							<?php endif;?>
							<a href="<?=$url;?>" class="title"><?=$model->title;?></a>
							<p class="text ff-airbnb-cereal-app-book mb-2 mb-md-4"><?=$model->getShortDescription(100);?></p>
							<div class="d-flex justify-content-between align-items-center">
								<div class="author d-flex align-items-center justify-content-center">
									<?=Image::widget([
										'src' => $model->users->getAvatar('150'),
										'data_srcset' => $model->users->getAvatar('250').' 575w, '.$model->users->getAvatar('250').' 767w, '.$model->users->getAvatar('250').' 768w',
										'data_sizes' => '150w',
										'alt' => $model->title,
										'from_cdn' => false,
										'lazyload' => false,
										'css_class' => 'img-fluid me-1 rounded-50p d-block',
									]);?>
									<a href="/<?=$model->users->username;?>/" class="name"><?=$model->users->name;?></a>
								</div>
								<div class="date ff-airbnb-cereal-app-book"><?=date('M j, Y', $model->created_at);?></div>
							</div>
						</div>
					</div>
			<?php endforeach;?>
		</div>
		<?php if($display_see_all_link):?>
			<a class="see-all-link d-block d-md-none text-decoration-underline mb-6" href="#">See All</a>
		<?php endif;?>
	</div>
<?php endif;?>
