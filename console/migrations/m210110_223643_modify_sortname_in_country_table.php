<?php

use yii\db\Migration;

/**
 * Class m210110_223643_modify_sortname_in_country_table
 */
class m210110_223643_modify_sortname_in_country_table extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->renameColumn('countries', 'sortname', 'iso_code');
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		$this->renameColumn('countries', 'iso_code', 'sortname');
	}
	
	/*
	// Use up()/down() to run migration code without a transaction.
	public function up()
	{

	}

	public function down()
	{
		echo "m210110_223643_modify_sortname_in_country_table cannot be reverted.\n";

		return false;
	}
	*/
}
