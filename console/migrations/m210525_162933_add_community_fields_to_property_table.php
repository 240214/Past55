<?php

use yii\db\Migration;

/**
 * Class m210525_162933_add_community_fields_to_property_table
 */
class m210525_162933_add_community_fields_to_property_table extends Migration{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->addColumn('{{%properties}}', 'display_contact_widget', $this->integer(1)->notNull()->defaultValue(1)->after('description'));
		$this->addColumn('{{%properties}}', 'contact_widget_title', $this->string(100)->notNull()->defaultValue('Contact information for {PROPERTY_TITLE}')->after('display_contact_widget'));
		$this->addColumn('{{%properties}}', 'contact_phone', $this->string(50)->after('contacts'));
		$this->addColumn('{{%properties}}', 'contact_email', $this->string(50)->after('contact_phone'));
		$this->addColumn('{{%properties}}', 'contact_website', $this->string(255)->after('contact_email'));
		$this->addColumn('{{%properties}}', 'contact_address', $this->string(255)->after('contact_website'));
		$this->addColumn('{{%properties}}', 'display_office_hours_widget', $this->integer(1)->notNull()->defaultValue(0)->after('contact_address'));
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		$this->dropColumn('{{%properties}}', 'display_contact_widget');
		$this->dropColumn('{{%properties}}', 'contact_widget_title');
		$this->dropColumn('{{%properties}}', 'contact_phone');
		$this->dropColumn('{{%properties}}', 'contact_email');
		$this->dropColumn('{{%properties}}', 'contact_website');
		$this->dropColumn('{{%properties}}', 'contact_address');
		$this->dropColumn('{{%properties}}', 'display_office_hours_widget');
	}
	
	/*
	// Use up()/down() to run migration code without a transaction.
	public function up()
	{

	}

	public function down()
	{
		echo "m210525_162933_add_community_fields_to_property_table cannot be reverted.\n";

		return false;
	}
	*/
}
