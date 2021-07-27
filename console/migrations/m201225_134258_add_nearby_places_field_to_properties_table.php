<?php

use yii\db\Migration;

/**
 * Class m201225_134258_add_nearby_places_field_to_properties_table
 */
class m201225_134258_add_nearby_places_field_to_properties_table extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->addColumn('{{%properties}}', 'nearby_places', $this->text()->null()->after('address_lng'));
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		$this->dropColumn('{{%properties}}', 'nearby_places');
	}
	
	/*
	// Use up()/down() to run migration code without a transaction.
	public function up()
	{

	}

	public function down()
	{
		echo "m201225_134258_add_nearby_places_field_to_properties_table cannot be reverted.\n";

		return false;
	}
	*/
}
