<?php

use yii\db\Migration;

/**
 * Class m220329_133023_add_fields_to_posts_table
 */
class m220329_133023_add_fields_to_posts_table extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->addColumn('posts', 'meta_title', $this->string(255)->null()->after('content_list'));
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		$this->dropColumn('posts', 'meta_title');
	}
	
}
