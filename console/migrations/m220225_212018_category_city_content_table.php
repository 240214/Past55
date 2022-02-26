<?php

use yii\db\Migration;

/**
 * Class m220225_212018_category_city_content_table
 */
class m220225_212018_category_city_content_table extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->createTable('category_city_content', [
			'category_id' => $this->integer(11)->notNull()->defaultValue(0),
			'state_id' => $this->integer(11)->notNull()->defaultValue(0),
			'city_id' => $this->integer(11)->notNull()->defaultValue(0),
			'image' => $this->string(255),
			'title' => $this->string(255),
			'content' => $this->text(),
		]);

		$this->createIndex('idx_category_id', 'category', 'id');
		$this->createIndex('idx_state_id', 'states', 'id');
		$this->createIndex('idx_city_id', 'cities', 'id');
		
		$this->addForeignKey('fk_3c_category_id', 'category_city_content', 'category_id', 'category', 'id');
		$this->addForeignKey('fk_3c_state_id', 'category_city_content', 'state_id', 'states', 'id');
		$this->addForeignKey('fk_3c_city_id', 'category_city_content', 'city_id', 'cities', 'id');
		
		$this->createIndex('pk_3c', 'category_city_content', ['category_id', 'state_id', 'city_id'], true);
		$this->createIndex('idx_3c_title', 'category_city_content', 'title');
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		$this->dropIndex('idx_category_id', 'category');
		$this->dropIndex('idx_state_id', 'states');
		$this->dropIndex('idx_city_id', 'cities');
		$this->dropTable('category_city_content');
	}
}
