<?php

use yii\db\Migration;

/**
 * Class m220404_210558_add_fields_to_pages_table
 */
class m220404_210558_add_fields_to_pages_table extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->addColumn('pages', 'meta_noindex', $this->integer(1)->notNull()->defaultValue(0)->after('content'));
		$this->addColumn('pages', 'meta_description', $this->string(255)->null()->after('content'));
		$this->addColumn('pages', 'template', $this->string(255)->null()->after('content'));
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		$this->dropColumn('pages', 'template');
		$this->dropColumn('pages', 'meta_description');
		$this->dropColumn('pages', 'meta_noindex');
	}
	
}
