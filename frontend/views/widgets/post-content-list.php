<?php if(!empty($title)):?>
	<h4 class="article__content-title"><?=$title;?></h4>
<?php endif;?>
<?php foreach($content_list as $link => $title):?>
	<a href="<?=$link;?>" class="article__content-link text-decoration-none mb-1"><?=$title;?></a>
<?php endforeach;?>
