<?php

use yii\db\Migration;

/**
 * Class m210210_180125_add_feature_type_id_in_property_features_table
 */
class m210210_180125_add_feature_type_id_in_property_features_table extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->addColumn('{{%property_features}}', 'feature_type_id', $this->integer()->notNull()->defaultValue(0)->after('name'));
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		$this->dropColumn('{{%property_features}}', 'feature_type_id');
	}
	
	/*
	// Use up()/down() to run migration code without a transaction.
	public function up()
	{

	}

	public function down()
	{
		echo "m210210_180125_add_feature_type_id_in_property_features_table cannot be reverted.\n";

		return false;
	}
	*/
}
