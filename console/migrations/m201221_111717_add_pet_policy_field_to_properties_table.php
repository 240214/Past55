<?php

use yii\db\Migration;

/**
 * Class m201221_111717_add_pet_policy_field_to_properties_table
 */
class m201221_111717_add_pet_policy_field_to_properties_table extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->addColumn('{{%properties}}', 'pet_policy', $this->text()->null()->after('contacts'));
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		$this->dropColumn('{{%properties}}', 'pet_policy');
	}
	
	/*
	// Use up()/down() to run migration code without a transaction.
	public function up()
	{

	}

	public function down()
	{
		echo "m201221_111717_add_pet_policy_field_to_properties_table cannot be reverted.\n";

		return false;
	}
	*/
}
