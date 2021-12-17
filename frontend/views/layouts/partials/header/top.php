<?php

use frontend\models\PasswordResetRequestForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$reset = new PasswordResetRequestForm();
?>
<div class="header__top">
	<div class="container-lg">
		<ul class="top-nav">
			<?php if(!Yii::$app->user->isGuest):?>
				<li class="dropdown">
					<a role="button" id="dropdownUserMenuButton" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Hi <?=Yii::$app->user->identity->username;?>!</a>
					<ul class="dropdown-menu" aria-labelledby="dropdownUserMenuButton">
						<li><a href="<?=Url::toRoute('my/profile');?>">Profile</a></li>
						<li><a href="<?=Url::toRoute('dashboard/index');?>">Dashboard</a></li>
						<li><a href="<?=Url::toRoute('user/update');?>">profile Settings</a></li>
						<li><a href="<?=Url::toRoute('user/account');?>">Account Settings</a></li>
						<li><a href="<?=Url::toRoute('my/search');?>">Saved Searches</a></li>
						<li><a href="<?=Url::toRoute('my/saved/agents');?>">Saved Agents</a></li>
						<li><a href="<?=Url::toRoute('my/saved/property');?>">Saved Listings</a></li>
						<li><a data-method="GET" href="<?=Url::toRoute('site/logout');?>">Logout</a></li>
					</ul>
				</li>
				<li class="top-nav__icon">
					<a href="#">
						<i class="zmdi zmdi-notifications"></i>
						<i class="top-nav__alert"></i>
					</a>
				</li>
			<?php else:?>
				<li class="dropdown top-nav__guest">
					<a id="dropdownRegisterButton" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" role="button">Register</a>
					<div class="dropdown-menu" aria-labelledby="dropdownRegisterButton">
						<?php $form = ActiveForm::begin(['id' => 'signup-form', 'action' => ['site/signup']]); ?>
						<div class="form-group">
							<input type="email" name="SignupForm[email]" class="form-control" placeholder="Email Address">
							<i class="form-group__bar"></i>
						</div>
						<div class="form-group">
							<input type="text" name="SignupForm[username]" class="form-control" placeholder="username">
							<i class="form-group__bar"></i>
						</div>
						<div class="form-group">
							<input type="password" name="SignupForm[password]" class="form-control" placeholder="Password">
							<i class="form-group__bar"></i>
						</div>
						<p><small>By Signing up with Roost, you're agreeing to our <a href="javascript:void">terms and conditions</a>.</small></p>
						<button type="reset" class="btn btn-primary btn-block mt-3 mb-3">Register</button>
						<div class="text-center d-none">
							<small><a href="#">Are you an Agent?</a></small>
						</div>
						<div class="top-nav__auth d-none">
							<span>or</span>
							<div>Sign in using</div>
							<a href="#" class="mdc-bg-blue-500"><i class="zmdi zmdi-facebook"></i></a>
							<a href="#" class="mdc-bg-cyan-500"><i class="zmdi zmdi-twitter"></i></a>
							<a href="#" class="mdc-bg-red-400"><i class="zmdi zmdi-google"></i></a>
						</div>
						
						<?php ActiveForm::end(); ?>
					
					</div>
				</li>
				<li class="dropdown top-nav__guest">
					<a id="dropdownLoginButton" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" role="button" data-rmd-action="switch-login">Login</a>
					<div class="dropdown-menu" aria-labelledby="dropdownLoginButton">
						<div class="tab-content">
							<?php $form = ActiveForm::begin(['options' => ['class' => 'tab-pane active'], 'id' => 'top-nav-login', 'action' => Url::toRoute('site/login')]); ?>
							<div class="form-group">
								<input type="text" name="LoginForm[username]" value="demo" class="form-control" placeholder="Username">
								
								<i class="form-group__bar"></i>
							</div>
							
							<div class="form-group">
								<input type="password" name="LoginForm[password]" value="demo" class="form-control" placeholder="Password">
								<i class="form-group__bar"></i>
							</div>
							
							<button type="submit" class="btn btn-primary btn-block m-t-10 m-b-10">Login</button>
							
							<div class="text-center">
								<a href="#top-nav-forgot-password" data-toggle="tab">
									<small>Forgot email/password?</small>
								</a>
							</div>
							
							<div class="top-nav__auth ">
								<span>Or</span>
								
								<div>Connect with us on</div>
								
								<a href="//<?=Yii::$app->params['settings']['facebook'];?>" class="mdc-bg-blue-500">
									<i class="zmdi zmdi-facebook"></i>
								</a>
								
								<a href="//<?=Yii::$app->params['settings']['twiter']?>" class="mdc-bg-cyan-500">
									<i class="zmdi zmdi-twitter"></i>
								</a>
								
								<a href="//<?=Yii::$app->params['settings']['google']?>" class="mdc-bg-red-400">
									<i class="zmdi zmdi-google"></i>
								</a>
							</div>
							<?php ActiveForm::end(); ?>
							<?php $form = ActiveForm::begin(['id' => 'top-nav-forgot-password', 'options' => ['class' => 'tab-pane fade forgot-password'], 'action' => ['site/request-password-reset']]); ?>
							
							<a href="#top-nav-login" class="top-nav__back" data-toggle="tab"></a>
							
							<p>Please fill out your email. A link to reset password will be sent there.</p>
							
							<div class="form-group">
								<?=$form->field($reset, 'email', ['options' => ['class' => 'form-group form-group--float'], 'template' => " {input}\n {label} \n <i class='form-group__bar'></i> \n {hint} \n {error}"])->textInput(['options' => ['placeholder' => 'Email Address']]);?>
							
							</div>
							
							<button class="btn btn-warning btn-block">Reset Password</button>
							<?php ActiveForm::end(); ?>
						</div>
					</div>
				</li>
			<?php endif;?>
			<li class="pull-right top-nav__icon"><a href="//<?=Yii::$app->params['settings']['facebook'];?>"><i class="zmdi zmdi-facebook"></i></a></li>
			<li class="pull-right top-nav__icon"><a href="//<?=Yii::$app->params['settings']['twiter'];?>"><i class="zmdi zmdi-twitter"></i></a></li>
			<li class="pull-right top-nav__icon"><a href="//<?=Yii::$app->params['settings']['google'];?>"><i class="zmdi zmdi-google"></i></a></li>
			<li class="pull-right d-none d-sm-block"><span><i class="zmdi zmdi-email"></i><?=Yii::$app->params['settings']['email'];?></span></li>
			<li class="pull-right d-none d-sm-block"><span><i class="zmdi zmdi-phone"></i><?=Yii::$app->params['settings']['mobile'];?></span></li>
		</ul>
	</div>
</div>

