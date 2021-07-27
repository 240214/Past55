<?php

use yii\db\Migration;

/**
 * Class m201228_001341_add_active_field_in_properties_table
 */
class m201228_001341_add_active_field_in_properties_table extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->addColumn('{{%properties}}', 'active', $this->integer()->notNull()->defaultValue(1)->after('radius'));
		$this->dropColumn('{{%properties}}', 'status');
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		$this->dropColumn('{{%properties}}', 'active');
		$this->addColumn('{{%properties}}', 'status', $this->text()->null()->after('radius'));
	}
	
	/*
	// Use up()/down() to run migration code without a transaction.
	public function up()
	{

	}

	public function down()
	{
		echo "m201228_001341_add_active_field_in_properties_table cannot be reverted.\n";

		return false;
	}
	*/
}
