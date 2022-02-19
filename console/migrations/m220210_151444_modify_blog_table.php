<?php

use yii\db\Migration;

/**
 * Class m220210_151444_modify_blog_table
 */
class m220210_151444_modify_blog_table extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->dropColumn('blog', 'author_name');
		$this->dropColumn('blog', 'author_image');
		$this->dropColumn('blog', 'blog_author');
		$this->dropColumn('blog', 'bloge_id');
		$this->renameColumn('blog', 'blog_image', 'image');
		$this->renameColumn('blog', 'blog_title', 'title');
		$this->renameColumn('blog', 'blog_body', 'content');
		$this->renameColumn('blog', 'blog_tags', 'tag_id');
		$this->alterColumn('blog', 'tag_id', 'int(11)');
		$this->renameColumn('blog', 'blog_comments', 'comment_id');
		$this->alterColumn('blog', 'comment_id', 'int(11)');
		
		$this->addForeignKey('fk_blog_tag_id', 'blog', 'tag_id', 'blog_tags', 'id');
		$this->addForeignKey('fk_blog_comment_id', 'blog', 'comment_id', 'blog_comment', 'id');
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		return false;
	}
	
}
