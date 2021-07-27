<?php

use yii\db\Migration;

/**
 * Class m210225_184930_change_lat_lng_fields_type_in_property_table
 */
class m210225_184930_change_lat_lng_fields_type_in_property_table extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->alterColumn('properties', 'address_lat', $this->string(60)->notNull()->defaultValue(0));
		$this->alterColumn('properties', 'address_lng', $this->string(60)->notNull()->defaultValue(0));
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		echo "m210225_184930_change_lat_lng_fields_type_in_property_table cannot be reverted.\n";
		
		return true;
	}
	
	/*
	// Use up()/down() to run migration code without a transaction.
	public function up()
	{

	}

	public function down()
	{
		echo "m210225_184930_change_lat_lng_fields_type_in_property_table cannot be reverted.\n";

		return false;
	}
	*/
}
