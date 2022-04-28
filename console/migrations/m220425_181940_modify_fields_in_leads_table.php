<?php

use yii\db\Migration;

/**
 * Class m220425_181940_modify_fields_in_leads_table
 */
class m220425_181940_modify_fields_in_leads_table extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->renameColumn('leads', 'mobile', 'phone');
		#$this->renameColumn('leads', 'sender', 'name');
		$this->dropColumn('leads', 'reciever');
		$this->dropColumn('leads', 'image');
		$this->dropColumn('leads', 'title');
		$this->dropColumn('leads', 'status');
		$this->dropColumn('leads', 'created_at');
		$this->addColumn('leads', 'created_at', $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE NOW()'));
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		return true;
	}
	
}
