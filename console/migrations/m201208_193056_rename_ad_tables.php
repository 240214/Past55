<?php

use yii\db\Migration;

/**
 * Class m201208_193056_rename_ad_tables
 */
class m201208_193056_rename_ad_tables extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->renameColumn('ad_configuration', 'ads_id', 'property_id');
		$this->renameColumn('views', 'ad_id', 'property_id');
		$this->renameTable('ad', 'properties');
		$this->renameTable('ad_configuration', 'property_configuration');
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		$this->renameColumn('property_configuration', 'property_id', 'ads_id');
		$this->renameColumn('views', 'property_id', 'ad_id');
		$this->renameTable('properties', 'ad');
		$this->renameTable('property_configuration', 'ad_configuration');
	}
	
	/*
	// Use up()/down() to run migration code without a transaction.
	public function up()
	{

	}

	public function down()
	{
		echo "m201208_193056_rename_ad_tables cannot be reverted.\n";

		return false;
	}
	*/
}
