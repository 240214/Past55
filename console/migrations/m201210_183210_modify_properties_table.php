<?php

use yii\db\Migration;

/**
 * Class m201210_183210_modify_properties_table
 */
class m201210_183210_modify_properties_table extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->renameColumn('properties', 'category', 'category_id');
		//$this->renameColumn('properties', 'sub_category', 'sub_category_id');
		$this->alterColumn('properties', 'category_id', 'int(11)');
		//$this->alterColumn('properties', 'sub_category_id', 'int(11)');
		$this->addForeignKey('fk_properties_user_id', 'properties', 'user_id', 'user', 'id');
		$this->addForeignKey('fk_properties_category_id', 'properties', 'category_id', 'category', 'id');
		//$this->addForeignKey('fk_properties_sub_category_id', 'properties', 'sub_category_id', 'sub_category', 'id');
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		$this->dropForeignKey('fk_properties_user_id', 'properties');
		$this->dropForeignKey('fk_properties_category_id', 'properties');
		//$this->dropForeignKey('fk_properties_sub_category_id', 'properties');
		$this->renameColumn('properties', 'category_id', 'category');
		//$this->renameColumn('properties', 'sub_category_id', 'sub_category');
	}
	
	/*
	// Use up()/down() to run migration code without a transaction.
	public function up()
	{

	}

	public function down()
	{
		echo "m201210_183210_modify_properties_table cannot be reverted.\n";

		return false;
	}
	*/
}
