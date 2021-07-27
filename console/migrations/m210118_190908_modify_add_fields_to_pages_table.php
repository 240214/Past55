<?php

use yii\db\Migration;

/**
 * Class m210118_190908_modify_add_fields_to_pages_table
 */
class m210118_190908_modify_add_fields_to_pages_table extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->addColumn('{{%pages}}', 'slug', $this->string(255)->null()->after('title'));
		$this->addColumn('{{%pages}}', 'active', $this->integer()->notNull()->defaultValue(1)->after('content'));
		$this->dropColumn('{{%pages}}', 'status');
		
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		echo "m210118_190908_modify_add_fields_to_pages_table cannot be reverted.\n";
		
		return false;
	}
	
	/*
	// Use up()/down() to run migration code without a transaction.
	public function up()
	{

	}

	public function down()
	{
		echo "m210118_190908_modify_add_fields_to_pages_table cannot be reverted.\n";

		return false;
	}
	*/
}
