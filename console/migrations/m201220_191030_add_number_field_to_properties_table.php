<?php

use yii\db\Migration;

/**
 * Class m201220_191030_add_number_field_to_properties_table
 */
class m201220_191030_add_number_field_to_properties_table extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->addColumn('{{%properties}}', 'prop_number', $this->text(10)->null()->after('location'));
		
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		$this->dropColumn('{{%properties}}', 'prop_number');
	}
	
	/*
	// Use up()/down() to run migration code without a transaction.
	public function up()
	{

	}

	public function down()
	{
		echo "m201220_191030_add_number_field_to_properties_table cannot be reverted.\n";

		return false;
	}
	*/
}
