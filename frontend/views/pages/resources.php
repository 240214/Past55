<?php

use common\models\Users;
use frontend\assets\AppAsset;
use \yii\bootstrap\ActiveForm;
use yii\bootstrap\BootstrapAsset;

$this->registerMetaTag(['name' => 'description', 'content' => $model->meta_description]);
$this->registerMetaTag(['name' => 'keywords', 'content' => '']);
if($model->meta_noindex){
	$this->registerMetaTag(['name' => 'robots', 'content' => 'noindex,nofollow']);
}
$this->title = $model->title;
$this->params['breadcrumbs'][] = $this->title;
#$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile('@web/theme/css/pages/resources.css', ['depends' => [BootstrapAsset::className(), AppAsset::className()]]);

?>
<section class="content-library">
	<div class="content-library__body">
		<div class="container">
			<h1 class="main-title text-center mb-1 mb-md-2"><?=$model->title;?></h1>
			<p class="main-text-content text-center mb-5 mb-md-7">People started talking about E‑A-T in August 2018, and it’s been mentioned<br>in hundreds of SEO articles ever since.</p>

			<div class="d-flex justify-content-between mb-1 mb-md-3">
				<h3 class="content-library__row-title">Skilled Nursing</h3>
				<a class="content-library__see-all-link d-none d-md-block text-decoration-underline" href="#">See All</a>
			</div>
			<div class="content-library__slider-1 row mb-2 mb-md-6">
				<div class="col-12 col-xxl-4 mx-1">
					<div class="content-card bg-white">
						<img class="img-fluid mb-2 mb-md-3" src="./img/content-card-img-1.png" alt="">
						<div class="p-2 pt-0">
							<a href="#" class="content-card__title mb-1 mb-md-2 text-decoration-none">No one cares until someone cares; be that one!</a>
							<p class="content-card__text mb-2 mb-md-4">The phrase ‘Love one another’ is so wise. By loving one another, we invest in each other and ourselves</p>
							<div class="d-flex justify-content-between align-items-center">
								<div class="d-flex align-items-center justify-content-center">
									<img class="me-1" src="./img/content-card-author-img-1.png" alt="">
									<span class="content-card__author-name">Wade Warren</span>
								</div>
								<div class="content-card__date">July 31, 2021</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-xxl-4 mx-1">
					<div class="content-card bg-white">
						<img class="img-fluid mb-2 mb-md-3" src="./img/content-card-img-2.png" alt="">
						<div class="p-2 pt-0">
							<a href="#" class="content-card__title mb-1 mb-md-2 text-decoration-none">No one cares until someone cares; be that one!</a>
							<p class="content-card__text mb-2 mb-md-4">The phrase ‘Love one another’ is so wise. By loving one another, we invest in each other and ourselves</p>
							<div class="d-flex justify-content-between align-items-center">
								<div class="d-flex align-items-center justify-content-center">
									<img class="me-1" src="./img/content-card-author-img-2.png" alt="">
									<span class="content-card__author-name">Jenny Wilson</span>
								</div>
								<div class="content-card__date">July 31, 2021</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-xxl-4 mx-1">
					<div class="content-card bg-white">
						<img class="img-fluid mb-2 mb-md-3" src="./img/content-card-img-3.png" alt="">
						<div class="p-2 pt-0">
							<a href="#" class="content-card__title mb-1 mb-md-2 text-decoration-none">No one cares until someone cares; be that one!</a>
							<p class="content-card__text mb-2 mb-md-4">The phrase ‘Love one another’ is so wise. By loving one another, we invest in each other and ourselves</p>
							<div class="d-flex justify-content-between align-items-center">
								<div class="d-flex align-items-center justify-content-center">
									<img class="me-1" src="./img/content-card-author-img-3.png" alt="">
									<span class="content-card__author-name">Jacob Jones</span>
								</div>
								<div class="content-card__date">July 31, 2021</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-xxl-4 mx-1">
					<div class="content-card bg-white">
						<img class="img-fluid mb-2 mb-md-3" src="./img/content-card-img-3.png" alt="">
						<div class="p-2 pt-0">
							<a href="#" class="content-card__title mb-1 mb-md-2 text-decoration-none">No one cares until someone cares; be that one!</a>
							<p class="content-card__text mb-2 mb-md-4">The phrase ‘Love one another’ is so wise. By loving one another, we invest in each other and ourselves</p>
							<div class="d-flex justify-content-between align-items-center">
								<div class="d-flex align-items-center justify-content-center">
									<img class="me-1" src="./img/content-card-author-img-3.png" alt="">
									<span class="content-card__author-name">Jacob Jones</span>
								</div>
								<div class="content-card__date">July 31, 2021</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<a class="content-library__see-all-link d-block d-md-none text-decoration-underline mb-6" href="#">See All</a>

			<div class="d-flex justify-content-between mb-1 mb-md-3">
				<h3 class="content-library__row-title">Skilled Nursing</h3>
				<a class="content-library__see-all-link d-none d-md-block text-decoration-underline" href="#">See All</a>
			</div>
			<div class="content-library__slider-2 row mb-2 mb-md-6">
				<div class="col-12 col-xl-4 mx-1">
					<div class="content-card bg-white">
						<img class="img-fluid mb-2 mb-md-3" src="./img/content-card-img-4.png" alt="">
						<div class="p-2 pt-0">
							<a href="#" class="content-card__title mb-1 mb-md-2 text-decoration-none">No one cares until someone cares; be that one!</a>
							<p class="content-card__text mb-2 mb-md-4">The phrase ‘Love one another’ is so wise. By loving one another, we invest in each other and ourselves</p>
							<div class="d-flex justify-content-between align-items-center">
								<div class="d-flex align-items-center justify-content-center">
									<img class="me-1" src="./img/content-card-author-img-4.png" alt="">
									<span class="content-card__author-name">Esther Howard</span>
								</div>
								<div class="content-card__date">July 31, 2021</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-xl-4 mx-1">
					<div class="content-card bg-white">
						<img class="img-fluid mb-2 mb-md-3" src="./img/content-card-img-5.png" alt="">
						<div class="p-2 pt-0">
							<a href="#" class="content-card__title mb-1 mb-md-2 text-decoration-none">No one cares until someone cares; be that one!</a>
							<p class="content-card__text mb-2 mb-md-4">The phrase ‘Love one another’ is so wise. By loving one another, we invest in each other and ourselves</p>
							<div class="d-flex justify-content-between align-items-center">
								<div class="d-flex align-items-center justify-content-center">
									<img class="me-1" src="./img/content-card-author-img-5.png" alt="">
									<span class="content-card__author-name">Eleanor Pena</span>
								</div>
								<div class="content-card__date">July 31, 2021</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-xl-4 mx-1">
					<div class="content-card bg-white">
						<img class="img-fluid mb-2 mb-md-3" src="./img/content-card-img-6.png" alt="">
						<div class="p-2 pt-0">
							<a href="#" class="content-card__title mb-1 mb-md-2 text-decoration-none">No one cares until someone cares; be that one!</a>
							<p class="content-card__text mb-2 mb-md-4">The phrase ‘Love one another’ is so wise. By loving one another, we invest in each other and ourselves</p>
							<div class="d-flex justify-content-between align-items-center">
								<div class="d-flex align-items-center justify-content-center">
									<img class="me-1" src="./img/content-card-author-img-6.png" alt="">
									<span class="content-card__author-name">Arlene McCoy</span>
								</div>
								<div class="content-card__date">July 31, 2021</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-xl-4 mx-1">
					<div class="content-card bg-white">
						<img class="img-fluid mb-2 mb-md-3" src="./img/content-card-img-6.png" alt="">
						<div class="p-2 pt-0">
							<a href="#" class="content-card__title mb-1 mb-md-2 text-decoration-none">No one cares until someone cares; be that one!</a>
							<p class="content-card__text mb-2 mb-md-4">The phrase ‘Love one another’ is so wise. By loving one another, we invest in each other and ourselves</p>
							<div class="d-flex justify-content-between align-items-center">
								<div class="d-flex align-items-center justify-content-center">
									<img class="me-1" src="./img/content-card-author-img-6.png" alt="">
									<span class="content-card__author-name">Arlene McCoy</span>
								</div>
								<div class="content-card__date">July 31, 2021</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<a class="content-library__see-all-link d-block d-md-none text-decoration-underline mb-6" href="#">See All</a>

			<div class="d-flex justify-content-between mb-1 mb-md-3">
				<h3 class="content-library__row-title">Skilled Nursing</h3>
				<a class="content-library__see-all-link d-none d-md-block text-decoration-underline" href="#">See All</a>
			</div>
			<div class="content-library__slider-3 row mb-2 mb-md-6">
				<div class="col-12 col-xl-4 mx-1">
					<div class="content-card bg-white">
						<img class="img-fluid mb-2 mb-md-3" src="./img/content-card-img-7.png" alt="">
						<div class="p-2 pt-0">
							<a href="#" class="content-card__title mb-1 mb-md-2 text-decoration-none">No one cares until someone cares; be that one!</a>
							<p class="content-card__text mb-2 mb-md-4">The phrase ‘Love one another’ is so wise. By loving one another, we invest in each other and ourselves</p>
							<div class="d-flex justify-content-between align-items-center">
								<div class="d-flex align-items-center justify-content-center">
									<img class="me-1" src="./img/content-card-author-img-7.png" alt="">
									<span class="content-card__author-name">Theresa Webb</span>
								</div>
								<div class="content-card__date">July 31, 2021</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-xl-4 mx-1">
					<div class="content-card bg-white">
						<img class="img-fluid mb-2 mb-md-3" src="./img/content-card-img-8.png" alt="">
						<div class="p-2 pt-0">
							<a href="#" class="content-card__title mb-1 mb-md-2 text-decoration-none">No one cares until someone cares; be that one!</a>
							<p class="content-card__text mb-2 mb-md-4">The phrase ‘Love one another’ is so wise. By loving one another, we invest in each other and ourselves</p>
							<div class="d-flex justify-content-between align-items-center">
								<div class="d-flex align-items-center justify-content-center">
									<img class="me-1" src="./img/content-card-author-img-8.png" alt="">
									<span class="content-card__author-name">Jerome Bell</span>
								</div>
								<div class="content-card__date">July 31, 2021</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-xl-4 mx-1">
					<div class="content-card bg-white">
						<img class="img-fluid mb-2 mb-md-3" src="./img/content-card-img-9.png" alt="">
						<div class="p-2 pt-0">
							<a href="#" class="content-card__title mb-1 mb-md-2 text-decoration-none">No one cares until someone cares; be that one!</a>
							<p class="content-card__text mb-2 mb-md-4">The phrase ‘Love one another’ is so wise. By loving one another, we invest in each other and ourselves</p>
							<div class="d-flex justify-content-between align-items-center">
								<div class="d-flex align-items-center justify-content-center">
									<img class="me-1" src="./img/content-card-author-img-9.png" alt="">
									<span class="content-card__author-name">Marvin McKinney</span>
								</div>
								<div class="content-card__date">July 31, 2021</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-xl-4 mx-1">
					<div class="content-card bg-white">
						<img class="img-fluid mb-2 mb-md-3" src="./img/content-card-img-9.png" alt="">
						<div class="p-2 pt-0">
							<a href="#" class="content-card__title mb-1 mb-md-2 text-decoration-none">No one cares until someone cares; be that one!</a>
							<p class="content-card__text mb-2 mb-md-4">The phrase ‘Love one another’ is so wise. By loving one another, we invest in each other and ourselves</p>
							<div class="d-flex justify-content-between align-items-center">
								<div class="d-flex align-items-center justify-content-center">
									<img class="me-1" src="./img/content-card-author-img-9.png" alt="">
									<span class="content-card__author-name">Marvin McKinney</span>
								</div>
								<div class="content-card__date">July 31, 2021</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<a class="content-library__see-all-link d-block d-md-none text-decoration-underline mb-6" href="#">See All</a>

		</div>
	</div>
</section>

<section class="container pt-3 pt-md-9 pb-1">
	<div class="d-flex justify-content-between mb-1 mb-md-3">
		<h3 class="latest-articles__row-title">Latest Articles</h3>
		<a class="content-library__see-all-link d-none d-md-block text-decoration-underline" href="#">See All</a>
	</div>
	<div class="content-library__slider-4 row mb-2 mb-md-6">
		<div class="col-12 col-xl-4 mx-1">
			<div class="content-card bg-white">
				<img class="img-fluid mb-2 mb-md-3" src="./img/content-card-img-10.png" alt="">
				<div class="p-2 pt-0">
					<div class="content-card__post-type">Block Post</div>
					<a href="#" class="content-card__title mb-1 mb-md-2 text-decoration-none">No one cares until someone cares; be that one!</a>
					<p class="content-card__text mb-2 mb-md-4">The phrase ‘Love one another’ is so wise. By loving one another, we invest in each other and ourselves</p>
					<div class="d-flex justify-content-between align-items-center">
						<div class="d-flex align-items-center justify-content-center">
							<img class="me-1" src="./img/content-card-author-img-10.png" alt="">
							<span class="content-card__author-name">Theresa Webb</span>
						</div>
						<div class="content-card__date">July 31, 2021</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12 col-xl-4 mx-1">
			<div class="content-card bg-white">
				<img class="img-fluid mb-2 mb-md-3" src="./img/content-card-img-11.png" alt="">
				<div class="p-2 pt-0">
					<div class="content-card__post-type">Block Post</div>
					<a href="#" class="content-card__title mb-1 mb-md-2 text-decoration-none">No one cares until someone cares; be that one!</a>
					<p class="content-card__text mb-2 mb-md-4">The phrase ‘Love one another’ is so wise. By loving one another, we invest in each other and ourselves</p>
					<div class="d-flex justify-content-between align-items-center">
						<div class="d-flex align-items-center justify-content-center">
							<img class="me-1" src="./img/content-card-author-img-11.png" alt="">
							<span class="content-card__author-name">Jerome Bell</span>
						</div>
						<div class="content-card__date">July 31, 2021</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12 col-xl-4 mx-1">
			<div class="content-card bg-white">
				<img class="img-fluid mb-2 mb-md-3" src="./img/content-card-img-12.png" alt="">
				<div class="p-2 pt-0">
					<div class="content-card__post-type">Block Post</div>
					<a href="#" class="content-card__title mb-1 mb-md-2 text-decoration-none">No one cares until someone cares; be that one!</a>
					<p class="content-card__text mb-2 mb-md-4">The phrase ‘Love one another’ is so wise. By loving one another, we invest in each other and ourselves</p>
					<div class="d-flex justify-content-between align-items-center">
						<div class="d-flex align-items-center justify-content-center">
							<img class="me-1" src="./img/content-card-author-img-12.png" alt="">
							<span class="content-card__author-name">Marvin McKinney</span>
						</div>
						<div class="content-card__date">July 31, 2021</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12 col-xl-4 mx-1">
			<div class="content-card bg-white">
				<img class="img-fluid mb-2 mb-md-3" src="./img/content-card-img-12.png" alt="">
				<div class="p-2 pt-0">
					<div class="content-card__post-type">Block Post</div>
					<a href="#" class="content-card__title mb-1 mb-md-2 text-decoration-none">No one cares until someone cares; be that one!</a>
					<p class="content-card__text mb-2 mb-md-4">The phrase ‘Love one another’ is so wise. By loving one another, we invest in each other and ourselves</p>
					<div class="d-flex justify-content-between align-items-center">
						<div class="d-flex align-items-center justify-content-center">
							<img class="me-1" src="./img/content-card-author-img-12.png" alt="">
							<span class="content-card__author-name">Marvin McKinney</span>
						</div>
						<div class="content-card__date">July 31, 2021</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<a class="content-library__see-all-link d-block d-md-none text-decoration-underline mb-1" href="#">See All</a>
</section>
