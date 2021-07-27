<?php

use yii\db\Migration;

/**
 * Class m210309_205314_modify_setting_value_field_in_settings_table
 */
class m210309_205314_modify_setting_value_field_in_settings_table extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->alterColumn('settings', 'setting_value', $this->text());
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		$this->alterColumn('settings', 'setting_value', $this->string(255));
	}
	
	/*
	// Use up()/down() to run migration code without a transaction.
	public function up()
	{

	}

	public function down()
	{
		echo "m210309_205314_modify_setting_value_field_in_settings_table cannot be reverted.\n";

		return false;
	}
	*/
}
