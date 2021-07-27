<?php

use yii\db\Migration;

/**
 * Class m201228_131536_modify_number_fields_types_in_properties_table
 */
class m201228_131536_modify_number_fields_types_in_properties_table extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->alterColumn('properties', 'bedrooms', $this->integer(2)->notNull()->defaultValue(0));
		$this->alterColumn('properties', 'bathrooms', $this->integer(2)->notNull()->defaultValue(0));
		$this->alterColumn('properties', 'size', $this->integer(6)->notNull()->defaultValue(0));
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		echo "m201228_131536_modify_number_fields_types_in_properties_table cannot be reverted.\n";
		
		return true;
	}
	
	/*
	// Use up()/down() to run migration code without a transaction.
	public function up()
	{

	}

	public function down()
	{
		echo "m201228_131536_modify_number_fields_types_in_properties_table cannot be reverted.\n";

		return false;
	}
	*/
}
