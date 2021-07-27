<?php

use yii\db\Migration;

/**
 * Class m210516_142305_add_order_field_in_settings_table
 */
class m210516_142305_add_order_field_in_settings_table extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->addColumn('{{%settings}}', 'order', $this->integer(10)->notNull()->defaultValue(0));
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		$this->dropColumn('{{%settings}}', 'order');
	}
	
	/*
	// Use up()/down() to run migration code without a transaction.
	public function up()
	{

	}

	public function down()
	{
		echo "m210516_142305_add_order_field_in_settings_table cannot be reverted.\n";

		return false;
	}
	*/
}
