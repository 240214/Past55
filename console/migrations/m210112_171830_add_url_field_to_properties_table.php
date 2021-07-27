<?php

use yii\db\Migration;

/**
 * Class m210112_171830_add_url_field_to_properties_table
 */
class m210112_171830_add_url_field_to_properties_table extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->addColumn('{{%properties}}', 'slug', $this->string(255)->null()->after('title'));
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		$this->dropColumn('{{%properties}}', 'slug');
	}
	
	/*
	// Use up()/down() to run migration code without a transaction.
	public function up()
	{

	}

	public function down()
	{
		echo "m210112_171830_add_url_field_to_properties_table cannot be reverted.\n";

		return false;
	}
	*/
}
