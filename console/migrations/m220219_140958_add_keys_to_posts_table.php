<?php

use yii\db\Migration;

/**
 * Class m220219_140958_add_keys_to_posts_table
 */
class m220219_140958_add_keys_to_posts_table extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->addForeignKey('fk_posts_user_id', 'posts', 'user_id', 'users', 'id');
		
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		$this->dropForeignKey('fk_posts_user_id', 'posts');
	}
}
