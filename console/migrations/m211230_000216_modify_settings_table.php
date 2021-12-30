<?php

use yii\db\Migration;

/**
 * Class m211230_000216_modify_settings_table
 */
class m211230_000216_modify_settings_table extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->addColumn('{{%settings}}', 'setting_title', $this->text());
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		$this->dropColumn('{{%settings}}', 'setting_title');
	}
	
	/*
	// Use up()/down() to run migration code without a transaction.
	public function up()
	{

	}

	public function down()
	{
		echo "m211230_000216_modify_settings_table cannot be reverted.\n";

		return false;
	}
	*/
}
