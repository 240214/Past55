<?php

use yii\db\Migration;

/**
 * Class m210309_152227_add_order_field_to_property_features_type_table
 */
class m210309_152227_add_order_field_to_property_features_type_table extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->addColumn('{{%property_features_types}}', 'order', $this->integer(10)->notNull()->defaultValue(0));
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		$this->dropColumn('{{%property_features_types}}', 'order');
	}
	
	/*
	// Use up()/down() to run migration code without a transaction.
	public function up()
	{

	}

	public function down()
	{
		echo "m210309_152227_add_order_field_to_property_features_type_table cannot be reverted.\n";

		return false;
	}
	*/
}
