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
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		$this->renameColumn('leads', 'phone', 'mobile');
	}
	
}
