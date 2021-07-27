<?php

use yii\db\Migration;

/**
 * Class m210303_182448_rename_saved_property_table
 */
class m210303_182448_rename_saved_property_table extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->renameTable('saved_property', 'favorite_properties');
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		$this->renameTable('favorite_properties', 'saved_property');
	}
	
	/*
	// Use up()/down() to run migration code without a transaction.
	public function up()
	{

	}

	public function down()
	{
		echo "m210303_182448_rename_saved_property_table cannot be reverted.\n";

		return false;
	}
	*/
}
