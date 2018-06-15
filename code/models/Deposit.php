<?php

namespace app\models;

use app\models\behaviours\BalanceBehaviour;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "deposits".
 *
 * @property int $id
 * @property int $client_id
 * @property int $percent
 * @property int $balance
 * @property int $slice
 * @property int $created_at
 * @property int $updated_at
 */
class Deposit extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class
            ],
            [
                'class' => BalanceBehaviour::class
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'deposits';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['client_id', 'percent', 'balance'], 'required'],
            [['client_id', 'balance'], 'number'],
            ['percent', 'integer', 'min' => 1, 'max' => 100]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client_id' => 'Client',
            'percent' => 'Percent',
            'balance' => 'Balance',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getClient()
    {
        return $this->hasOne(Client::class, ['id' => 'client_id']);
    }
}
