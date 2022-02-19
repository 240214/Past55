<?php

use yii\db\Migration;

/**
 * Class m220219_142807_modify_posts_comments_table
 */
class m220219_142807_modify_posts_comments_table extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->renameColumn('posts_comments', 'blog_id', 'post_id');
		$this->renameColumn('posts_comments', 'like_comment', 'likes');
		$this->dropColumn('posts_comments', 'user_name');
		$this->dropColumn('posts_comments', 'user_image');
		$this->dropColumn('posts_comments', 'author');
		
		$this->addForeignKey('fk_comments_posts_id', 'posts_comments', 'post_id', 'posts', 'id');
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		echo "m220219_142807_modify_posts_comments_table cannot be reverted.\n";
		
		return false;
	}
	
}
