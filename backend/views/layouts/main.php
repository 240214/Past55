<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\helpers\Url;
use common\models\SiteSettings;

AppAsset::register($this);

$this->params['site'] = SiteSettings::find()->one();
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?=Yii::$app->language;?>">
	<?=$this->render('head.php');?>
	<body class="hold-transition skin-blue sidebar-mini">
		<?php $this->beginBody(); ?>
		<div class="wrapper">
			
			<?=$this->render('header.php');?>

			<!-- Left side column. contains the logo and sidebar -->
			<?=$this->render('sidebar-left.php');?>
		
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1><?=$this->title;;?> <small>Version 1.0</small></h1>
					<?=Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : []]);?>
					<br>
				</section>
		
				<!-- Main content -->
				<section class="content">
					<?=Alert::widget();?>
					<?=$content;?>
				</section>
			</div>
			
			<?=$this->render('footer.php');?>
		
			<!-- Control Sidebar -->
			<?=$this->render('sidebar-right.php');?>
		
		</div>
		<?php $this->endBody();?>
	</body>
</html>
<?php $this->endPage(); ?>
