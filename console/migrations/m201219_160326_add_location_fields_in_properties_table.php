<?php

use yii\db\Migration;

/**
 * Class m201219_160326_add_location_fields_in_properties_table
 */
class m201219_160326_add_location_fields_in_properties_table extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->addColumn('{{%properties}}', 'address_lng', $this->float([20, 15])->notNull()->defaultValue('0.000000000000000')->after('zipcode'));
		$this->addColumn('{{%properties}}', 'address_lat', $this->float([20, 15])->notNull()->defaultValue('0.000000000000000')->after('zipcode'));
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		$this->dropColumn('{{%properties}}', 'address_lng');
		$this->dropColumn('{{%properties}}', 'address_lat');
	}
	
	/*
	// Use up()/down() to run migration code without a transaction.
	public function up()
	{

	}

	public function down()
	{
		echo "m201219_160326_add_location_fields_in_properties_table cannot be reverted.\n";

		return false;
	}
	*/
}
