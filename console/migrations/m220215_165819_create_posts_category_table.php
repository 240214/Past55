<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%posts_category}}`.
 */
class m220215_165819_create_posts_category_table extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->createTable('{{%posts_categories}}', [
			'id'    => $this->primaryKey(),
			'title' => $this->char(255),
			'slug'  => $this->char(255),
		]);
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		$this->dropTable('{{%posts_category}}');
	}
}
