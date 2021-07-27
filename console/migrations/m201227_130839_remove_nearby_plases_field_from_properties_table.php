<?php

use yii\db\Migration;

/**
 * Class m201227_130839_remove_nearby_plases_field_from_properties_table
 */
class m201227_130839_remove_nearby_plases_field_from_properties_table extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->dropColumn('{{%properties}}', 'nearby_places');
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		$this->addColumn('{{%properties}}', 'nearby_places', $this->text()->null()->after('address_lng'));
	}
	
	/*
	// Use up()/down() to run migration code without a transaction.
	public function up()
	{

	}

	public function down()
	{
		echo "m201227_130839_remove_nearby_plases_field_from_properties_table cannot be reverted.\n";

		return false;
	}
	*/
}
