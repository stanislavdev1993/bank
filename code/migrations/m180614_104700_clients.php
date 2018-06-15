<?php

use yii\db\Migration;

/**
 * Class m180614_104700_clients
 */
class m180614_104700_clients extends Migration
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

        $this->createTable('{{%clients}}', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string(15),
            'surname' => $this->string(15),
            'gender' => $this->tinyInteger(1),
            'birthday' => $this->date()
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%clients}}');
    }
}
