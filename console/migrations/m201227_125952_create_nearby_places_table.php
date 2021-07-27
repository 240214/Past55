<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%nearby_places}}`.
 */
class m201227_125952_create_nearby_places_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%nearby_places}}', [
            'id' => $this->primaryKey(),
            'property_id' => $this->integer(11)->notNull()->defaultValue(0),
            'place_id'   => $this->string(100)->null(),
            'icon_url'   => $this->string(255)->null(),
            'name'   => $this->string(50)->null(),
            'address'   => $this->string(100)->null(),
            'type'   => $this->string(40)->null(),
            'rating'   => $this->float([1, 1])->notNull()->defaultValue(0),
            'lat'   => $this->float([20, 15])->notNull()->defaultValue(0),
            'lng'   => $this->float([20, 15])->notNull()->defaultValue(0),
            'distance' => $this->integer(10)->notNull()->defaultValue(0),
            'distance_type' => $this->string(10)->notNull()->defaultValue('m'),
            'active' => $this->integer(1)->notNull()->defaultValue(1),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%nearby_places}}');
    }
}
