<?php

use yii\db\Migration;

/**
 * Class m220215_162742_add_meta_fields_to_blog_table
 */
class m220215_162742_add_meta_fields_to_blog_table extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		#$this->addColumn('{{%blog}}', 'meta_title', $this->char(255)->after('title'));
		$this->addColumn('{{%blog}}', 'meta_description', $this->char(255)->after('content'));
		$this->addColumn('{{%blog}}', 'slug', $this->char(255)->after('meta_description'));
		$this->addColumn('{{%blog}}', 'type', $this->char(10)->after('slug'));
		$this->addColumn('{{%blog}}', 'category_id', $this->integer(11)->after('type'));
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		#$this->dropColumn('{{%blog}}', 'meta_title');
		$this->dropColumn('{{%blog}}', 'meta_description');
		$this->dropColumn('{{%blog}}', 'category_id');
		$this->dropColumn('{{%blog}}', 'type');
		$this->dropColumn('{{%blog}}', 'slug');
	}
	
}
