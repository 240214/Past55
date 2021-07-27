<?php

use yii\db\Migration;

/**
 * Class m210112_170840_add_iso_code_to_states_table
 */
class m210112_170840_add_iso_code_to_states_table extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->addColumn('{{%states}}', 'iso_code', $this->string(5)->null()->after('name'));
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		$this->dropColumn('{{%states}}', 'iso_code');
	}
	
	/*
	// Use up()/down() to run migration code without a transaction.
	public function up()
	{

	}

	public function down()
	{
		echo "m210112_170840_add_iso_code_to_states_table cannot be reverted.\n";

		return false;
	}
	*/
}
