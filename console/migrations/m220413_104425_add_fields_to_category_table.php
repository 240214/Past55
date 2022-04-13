<?php

use yii\db\Migration;

/**
 * Class m220413_104425_add_fields_to_category_table
 */
class m220413_104425_add_fields_to_category_table extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->renameColumn('category', 'title', 'h1_title');
		$this->addColumn('category', 'h1_title_for_state', $this->string(255)->null()->after('h1_title'));
		$this->addColumn('category', 'h1_title_for_state_city', $this->string(255)->null()->after('h1_title_for_state'));
		$this->addColumn('category', 'meta_title_for_state', $this->string(255)->null()->after('meta_title'));
		$this->addColumn('category', 'meta_title_for_state_city', $this->string(255)->null()->after('meta_title_for_state'));
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		$this->renameColumn('category', 'h1_title', 'title');
		$this->dropColumn('category', 'h1_title_for_state');
		$this->dropColumn('category', 'h1_title_for_state_city');
		$this->dropColumn('category', 'meta_title_for_state');
		$this->dropColumn('category', 'meta_title_for_state_city');
	}
	
}
