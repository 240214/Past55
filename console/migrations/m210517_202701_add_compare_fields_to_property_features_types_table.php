<?php

use yii\db\Migration;

/**
 * Class m210517_202701_add_compare_fields_to_property_features_types_table
 */
class m210517_202701_add_compare_fields_to_property_features_types_table extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->addColumn('{{%property_features_types}}', 'separated', $this->integer(1)->notNull()->defaultValue(0));
		$this->addColumn('{{%property_features_types}}', 'section_title', $this->string(255));
		$this->addColumn('{{%property_features_types}}', 'section_description', $this->text());
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		$this->dropColumn('{{%settings}}', 'separated');
		$this->dropColumn('{{%settings}}', 'section_title');
		$this->dropColumn('{{%settings}}', 'section_description');
	}
	
	/*
	// Use up()/down() to run migration code without a transaction.
	public function up()
	{

	}

	public function down()
	{
		echo "m210517_202701_add_compare_fields_to_property_features_types_table cannot be reverted.\n";

		return false;
	}
	*/
}
