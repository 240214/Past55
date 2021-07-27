<?php

use yii\db\Migration;

/**
 * Class m210309_194706_change_features_field_in_properties_table
 */
class m210309_194706_change_features_field_in_properties_table extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->alterColumn('properties', 'features', $this->text());
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		echo "m210309_194706_change_features_field_in_properties_table cannot be reverted.\n";
		
		return false;
	}
	
	/*
	// Use up()/down() to run migration code without a transaction.
	public function up()
	{

	}

	public function down()
	{
		echo "m210309_194706_change_features_field_in_properties_table cannot be reverted.\n";

		return false;
	}
	*/
}
