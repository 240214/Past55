<?php

use yii\db\Migration;

/**
 * Class m210301_172849_add_sid_field_in_saved_property_table
 */
class m210301_172849_add_sid_field_in_saved_property_table extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->addColumn('{{%saved_property}}', 'sid', $this->string(32)->after('user_id'));
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		$this->dropColumn('{{%saved_property}}', 'sid');
	}
	
	/*
	// Use up()/down() to run migration code without a transaction.
	public function up()
	{

	}

	public function down()
	{
		echo "m210301_172849_add_sid_field_in_saved_property_table cannot be reverted.\n";

		return false;
	}
	*/
}
