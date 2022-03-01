<?php

use yii\db\Migration;

/**
 * Handles the dropping of table `{{%foreign_keys_from_category_city_content}}`.
 */
class m220301_155048_drop_foreign_keys_from_category_city_content_table extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->dropForeignKey('fk_3c_category_id', 'category_city_content');
		$this->dropForeignKey('fk_3c_state_id', 'category_city_content');
		$this->dropForeignKey('fk_3c_city_id', 'category_city_content');
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		$this->addForeignKey('fk_3c_category_id', 'category_city_content', 'category_id', 'category', 'id');
		$this->addForeignKey('fk_3c_state_id', 'category_city_content', 'state_id', 'states', 'id');
		$this->addForeignKey('fk_3c_city_id', 'category_city_content', 'city_id', 'cities', 'id');
	}
}
