<?php

use yii\db\Migration;

/**
 * Class m210129_121536_add_meta_fields_to_category_table
 */
class m210129_121536_add_meta_fields_to_category_table extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->addColumn('{{%category}}', 'meta_title', $this->text()->null());
		$this->addColumn('{{%category}}', 'meta_keywords', $this->text()->null());
		$this->addColumn('{{%category}}', 'meta_description', $this->text()->null());
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		$this->dropColumn('{{%category}}', 'meta_title');
		$this->dropColumn('{{%category}}', 'meta_keywords');
		$this->dropColumn('{{%category}}', 'meta_description');
	}
	
	/*
	// Use up()/down() to run migration code without a transaction.
	public function up()
	{

	}

	public function down()
	{
		echo "m210129_121536_add_meta_fields_to_category_table cannot be reverted.\n";

		return false;
	}
	*/
}
