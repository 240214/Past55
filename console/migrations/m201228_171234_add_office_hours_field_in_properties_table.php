<?php

use yii\db\Migration;

/**
 * Class m201228_171234_add_office_hours_field_in_properties_table
 */
class m201228_171234_add_office_hours_field_in_properties_table extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->addColumn('{{%properties}}', 'office_hours', $this->text()->null()->after('contacts'));
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		$this->dropColumn('{{%properties}}', 'office_hours');
	}
	
	/*
	// Use up()/down() to run migration code without a transaction.
	public function up()
	{

	}

	public function down()
	{
		echo "m201228_171234_add_office_hours_field_in_properties_table cannot be reverted.\n";

		return false;
	}
	*/
}
