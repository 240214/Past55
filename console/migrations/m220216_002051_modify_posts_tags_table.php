<?php

use yii\db\Migration;

/**
 * Class m220216_002051_modify_posts_tags_table
 */
class m220216_002051_modify_posts_tags_table extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->renameColumn('posts_tags', 'blog', 'post_id');
		$this->addColumn('posts_tags', 'slug', $this->char(255)->after('tag'));
		$this->addForeignKey('fk_tags_posts_id', 'posts_tags', 'post_id', 'posts', 'id');
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		$this->dropForeignKey('fk_tags_posts_id', 'posts_tags');
		$this->renameColumn('posts_tags', 'post_id', 'blog');
		$this->dropColumn('posts_tags', 'slug');
	}
	
}
