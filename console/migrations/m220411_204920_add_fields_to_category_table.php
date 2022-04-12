<?php

use yii\db\Migration;

/**
 * Class m220411_204920_add_fields_to_category_table
 */
class m220411_204920_add_fields_to_category_table extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->addColumn('category', 'user_id', $this->integer(11)->notNull()->defaultValue(0)->after('id'));
		$this->addColumn('category', 'content_list', $this->text());
		$this->addColumn('category', 'created_at', $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE NOW()'));
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		$this->dropColumn('category', 'user_id');
		$this->dropColumn('category', 'content_list');
		$this->dropColumn('category', 'created_at');
	}
	
}
