<?php

use yii\db\Migration;

/**
 * Class m220215_220511_rename_blog_tables
 */
class m220215_220511_rename_blog_tables extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->dropForeignKey('fk_blog_tag_id', 'blog');
		$this->dropForeignKey('fk_blog_comment_id', 'blog');
		
		$this->renameTable('blog', 'posts');
		$this->renameTable('blog_comment', 'posts_comments');
		$this->renameTable('blog_tags', 'posts_tags');
		
		$this->addForeignKey('fk_posts_tag_id', 'posts', 'tag_id', 'posts_tags', 'id');
		$this->addForeignKey('fk_posts_comment_id', 'posts', 'comment_id', 'posts_comments', 'id');
		$this->addForeignKey('fk_posts_category_id', 'posts', 'category_id', 'posts_categories', 'id');
		
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		$this->dropForeignKey('fk_posts_tag_id', 'posts', 'tag_id', 'posts_tags', 'id');
		$this->dropForeignKey('fk_posts_comment_id', 'posts', 'comment_id', 'posts_comments', 'id');
		$this->dropForeignKey('fk_posts_category_id', 'posts', 'category_id', 'posts_categories', 'id');

		$this->renameTable('posts', 'blog');
		$this->renameTable('posts_comments', 'blog_comment');
		$this->renameTable('posts_tags', 'blog_tags');
		
		$this->addForeignKey('fk_blog_tag_id', 'blog', 'tag_id', 'blog_tags', 'id');
		$this->addForeignKey('fk_blog_comment_id', 'blog', 'comment_id', 'blog_comment', 'id');
	}
}
