<?php

use yii\db\Migration;

/**
 * Class m220303_231315_create_link_between_posts_and_category_tables
 */
class m220303_231315_create_link_between_posts_and_category_tables extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->dropForeignKey('fk_posts_category_id', 'posts', 'category_id', 'posts_categories', 'id');
		$this->addForeignKey('fk_posts_category_id', 'posts', 'category_id', 'category', 'id');
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		$this->dropForeignKey('fk_posts_category_id', 'posts', 'category_id', 'category', 'id');
		$this->addForeignKey('fk_posts_category_id', 'posts', 'category_id', 'posts_categories', 'id');
	}
}
