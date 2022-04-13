<?php

use yii\db\Migration;

/**
 * Class m220412_152327_modify_fields_in_posts_table
 */
class m220412_152327_modify_fields_in_posts_table extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->dropColumn('posts', 'created_at');
		$this->addColumn('posts', 'created_at', $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE NOW()'));
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		$this->dropColumn('posts', 'created_at');
		$this->addColumn('posts', 'created_at', $this->integer(11)->notNull()->defaultValue(0));
	}
	
}
