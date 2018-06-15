<?php

namespace app\models;

use app\models\behaviours\BalanceBehaviour;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "deposit_history".
 *
 * @property int $id
 * @property int $client_id
 * @property int $deposit_id
 * @property int $type
 * @property int $value
 * @property int $slice
 * @property int $created_at
 */
class DepositHistory extends \yii\db\ActiveRecord
{
    const TYPE_PERCENT = 1;
    const TYPE_COMMISSION = 2;

    public function behaviors()
    {
        return [
            [TimestampBehavior::class],
            [
                'class' => BalanceBehaviour::class,
                'balanceAttribute' => 'value'
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'deposit_history';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['client_id', 'deposit_id', 'type', 'value'], 'required'],
            [['client_id', 'deposit_id', 'value', 'safe'], 'integer'],
            ['type', 'in', 'range' => [self::TYPE_PERCENT, self::TYPE_COMMISSION]]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client_id' => 'Client ID',
            'deposit_id' => 'Deposit ID',
            'type' => 'Type',
            'value' => 'Value',
            'slice' => 'Slice',
            'created_at' => 'Created At',
        ];
    }
}
