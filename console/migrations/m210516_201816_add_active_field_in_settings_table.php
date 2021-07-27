<?php

use yii\db\Migration;

/**
 * Class m210516_201816_add_active_field_in_settings_table
 */
class m210516_201816_add_active_field_in_settings_table extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->addColumn('{{%settings}}', 'active', $this->integer(1)->notNull()->defaultValue(0));
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		$this->dropColumn('{{%settings}}', 'active');
	}
	
	/*
	// Use up()/down() to run migration code without a transaction.
	public function up()
	{

	}

	public function down()
	{
		echo "m210516_201816_add_active_field_in_settings_table cannot be reverted.\n";

		return false;
	}
	*/
}
