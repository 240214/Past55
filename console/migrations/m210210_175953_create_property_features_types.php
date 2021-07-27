<?php

use yii\db\Migration;

/**
 * Class m210210_175953_create_property_features_types
 */
class m210210_175953_create_property_features_types extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->createTable('{{%property_features_types}}', [
			'id'    => $this->primaryKey(),
			'title'  => $this->string(255)->null(),
		]);
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		$this->dropTable('{{%property_features_types}}');
	}
	
	/*
	// Use up()/down() to run migration code without a transaction.
	public function up()
	{

	}

	public function down()
	{
		echo "m210210_175953_create_property_features_types cannot be reverted.\n";

		return false;
	}
	*/
}
