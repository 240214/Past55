<?php

use yii\db\Migration;

/**
 * Class m210114_122309_add_slug_field_to_category_table
 */
class m210114_122309_add_slug_field_to_category_table extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->addColumn('{{%category}}', 'slug', $this->string(255)->null()->after('name'));
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		$this->dropColumn('{{%category}}', 'slug');
	}
	
	/*
	// Use up()/down() to run migration code without a transaction.
	public function up()
	{

	}

	public function down()
	{
		echo "m210114_122309_add_slug_field_to_category_table cannot be reverted.\n";

		return false;
	}
	*/
}
