<?php

use yii\db\Migration;

/**
 * Class m210110_115835_modify_radius_field_in_property_table
 */
class m210110_115835_modify_radius_field_in_property_table extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->alterColumn('properties', 'radius', $this->integer(11)->notNull()->defaultValue(5000));
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		echo "m210110_115835_modify_radius_field_in_property_table cannot be reverted.\n";
		
		return false;
	}
	
	/*
	// Use up()/down() to run migration code without a transaction.
	public function up()
	{

	}

	public function down()
	{
		echo "m210110_115835_modify_radius_field_in_property_table cannot be reverted.\n";

		return false;
	}
	*/
}
