<?php

use yii\db\Migration;

/**
 * Class m180615_174808_deposits
 */
class m180615_174808_deposits extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%deposits}}', [
            'id' => $this->primaryKey()->unsigned(),
            'client_id' => $this->integer()->unsigned(),
            'percent' => $this->tinyInteger(3)->unsigned(),
            'balance' => $this->bigInteger()->unsigned(),
            'slice' => $this->integer()->unsigned(),
            'created_at' => $this->integer()->unsigned(),
            'updated_at' => $this->integer()->unsigned()
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%deposits}}');
    }
}
