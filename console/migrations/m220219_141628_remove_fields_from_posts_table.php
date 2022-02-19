<?php

use yii\db\Migration;

/**
 * Class m220219_141628_remove_fields_from_posts_table
 */
class m220219_141628_remove_fields_from_posts_table extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->dropForeignKey('fk_posts_tag_id', 'posts');
		$this->dropForeignKey('fk_posts_comment_id', 'posts');

		$this->dropColumn('posts', 'tag_id');
		$this->dropColumn('posts', 'comment_id');
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		$this->addColumn('posts', 'tag_id', $this->integer(11)->after('category_id'));
		$this->addColumn('posts', 'comment_id', $this->integer(11)->after('tag_id'));

		$this->addForeignKey('fk_posts_tag_id', 'posts', 'tag_id', 'posts_tags', 'id');
		$this->addForeignKey('fk_posts_comment_id', 'posts', 'comment_id', 'posts_comments', 'id');
	}
	
	/*
	// Use up()/down() to run migration code without a transaction.
	public function up()
	{

	}

	public function down()
	{
		echo "m220219_141628_remove_fields_from_posts_table cannot be reverted.\n";

		return false;
	}
	*/
}
