<?php

use yii\db\Migration;

/**
 * Class m201220_232854_add_contacts_field_to_properties_table
 */
class m201220_232854_add_contacts_field_to_properties_table extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->addColumn('{{%properties}}', 'contacts', $this->text()->null()->after('description'));
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		$this->dropColumn('{{%properties}}', 'contacts');
	}
	
	/*
	// Use up()/down() to run migration code without a transaction.
	public function up()
	{

	}

	public function down()
	{
		echo "m201220_232854_add_contacts_field_to_properties_table cannot be reverted.\n";

		return false;
	}
	*/
}
