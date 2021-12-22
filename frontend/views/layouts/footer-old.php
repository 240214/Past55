<?php

use frontend\widgets\Links;
use yii\helpers\Url;

?>
<footer id="footer">
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<div class="footer__block">
					<a class="logo clearfix" href="#">
						<div class="logo__text">
							<span><?=Yii::$app->params['settings']['site_name']?></span>
							<span><?=Yii::$app->params['settings']['site_title']?></span>
						</div>
					</a>
					
					<address class="mt-3 f-14">
						<?=Yii::$app->params['settings']['address']?>
					</address>
					
					<div class="f-20"><?=Yii::$app->params['settings']['mobile']?></div>
					<div class="f-14 mt-2"><?=Yii::$app->params['settings']['email']?></div>
					
					<div class="f-20 mt-4">
						<a href="//<?=Yii::$app->params['settings']['google']?>" class="me-4"><i class="zmdi zmdi-google"></i></a>
						<a href="//<?=Yii::$app->params['settings']['facebook']?>" class="me-4"><i class="zmdi zmdi-facebook"></i></a>
						<a href="//<?=Yii::$app->params['settings']['twiter']?>"><i class="zmdi zmdi-twitter"></i></a>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="footer__block footer__block--blog">
					<div class="footer__title">Latest from our blog</div>
					<?php
					foreach($blog as $bl){
						$BlogUrl = Url::toRoute('blog/detail/'.base64_encode($bl['id']).'/'.str_replace(' ', '+', $bl['blog_title']))
						?>
						<a href="<?=$BlogUrl?>">
							<?=$bl['blog_title']?>
							<small>On <?=date('Y/m/d', $bl['created_at'])?> at <?=date('h:i', $bl['created_at'])?> </small>
						</a>
						<?php
					}
					?>
				</div>
			</div>
			<div class="col-md-4">
				<div class="footer__block">
					<div class="footer__title">Disclaimer</div>
					
					<div><?=Yii::$app->params['settings']['disclaimer']?></div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="footer__bottom">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<?=Links::widget(['links_type' => 'pages']);?>
				</div>
				<div class="col-md-6">
					<div class="footer__copyright"><?=Yii::$app->params['settings']['site_name'];?>, All Rights Reserved. © <?=date('Y');?></div>
				</div>
			</div>
		</div>
		
		<div class="footer__to-top" data-rmd-action="scroll-to" data-rmd-target="html">
			<i class="zmdi zmdi-chevron-up"></i>
		</div>
	</div>
</footer>
