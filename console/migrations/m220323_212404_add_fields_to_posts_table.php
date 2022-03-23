<?php

use yii\db\Migration;

/**
 * Class m220323_212404_add_fields_to_posts_table
 */
class m220323_212404_add_fields_to_posts_table extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->dropForeignKey('fk_posts_category_id', 'posts');
		$this->dropIndex('fk_posts_category_id', 'posts');
		#$this->truncateTable('posts_categories');
		#$this->truncateTable('posts_comments');
		#$this->truncateTable('posts_tags');
		#$this->truncateTable('posts');
		$this->addColumn('posts', 'post_category_id', $this->integer(11)->null()->after('category_id'));
		$this->addForeignKey('fk_posts_category_id', 'posts', 'post_category_id', 'posts_categories', 'id');
		$this->createIndex('fk_properties_category_id', 'posts', 'category_id');
		$this->addForeignKey('fk_properties_category', 'posts', 'category_id', 'category', 'id');
		
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		$this->dropForeignKey('fk_posts_category_id', 'posts');
		$this->dropForeignKey('fk_properties_category_id', 'posts');
		$this->addForeignKey('fk_posts_category_id', 'posts', 'category_id', 'category', 'id');
		$this->dropColumn('posts', 'post_category_id');
	}
	
}
