<?php

use yii\db\Migration;

/**
 * Class m180615_175804_deposit_history
 */
class m180615_175804_deposit_history extends Migration
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

        $this->createTable('{{%deposit_history}}', [
            'id' => $this->primaryKey()->unsigned(),
            'deposit_id' => $this->integer()->unsigned(),
            'type' => $this->tinyInteger(1)->unsigned(),
            'value' => $this->integer()->unsigned(),
            'slice' => $this->integer()->unsigned(),
            'created_at' => $this->integer()->unsigned()
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%deposit_history}}');
    }
}
