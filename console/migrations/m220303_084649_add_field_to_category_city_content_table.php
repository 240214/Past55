<?php

use yii\db\Migration;

/**
 * Class m220303_084649_add_field_to_category_city_content_table
 */
class m220303_084649_add_field_to_category_city_content_table extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->addColumn('category_city_content', 'active', $this->integer(1)->notNull()->defaultValue(1));
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		$this->dropColumn('category_city_content', 'active');
	}
	
}
