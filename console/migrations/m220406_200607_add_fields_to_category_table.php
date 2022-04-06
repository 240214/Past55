<?php

use yii\db\Migration;

/**
 * Class m220406_200607_add_fields_to_category_table
 */
class m220406_200607_add_fields_to_category_table extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->addColumn('category', 'title', $this->string(255)->null()->after('name'));
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		$this->dropColumn('category', 'title');
	}
	
}
