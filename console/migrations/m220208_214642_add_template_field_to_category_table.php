<?php

use yii\db\Migration;

/**
 * Class m220208_214642_add_template_field_to_category_table
 */
class m220208_214642_add_template_field_to_category_table extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->addColumn('{{%category}}', 'template', $this->string(100)->after('icon'));
		
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		$this->dropColumn('{{%category}}', 'template');
	}
	
}
