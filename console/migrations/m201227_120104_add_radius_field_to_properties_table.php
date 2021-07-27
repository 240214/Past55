<?php

use yii\db\Migration;

/**
 * Class m201227_120104_add_radius_field_to_properties_table
 */
class m201227_120104_add_radius_field_to_properties_table extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->addColumn('{{%properties}}', 'radius', $this->integer()->notNull()->defaultValue(0)->after('address_lng'));
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		$this->dropColumn('{{%properties}}', 'radius');
	}
	
	/*
	// Use up()/down() to run migration code without a transaction.
	public function up()
	{

	}

	public function down()
	{
		echo "m201227_120104_add_radius_field_to_properties_table cannot be reverted.\n";

		return false;
	}
	*/
}
