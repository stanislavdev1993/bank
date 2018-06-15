<?php

namespace app\models\behaviours;

use yii\base\Behavior;
use yii\base\Event;
use yii\db\ActiveRecord;

class BalanceBehaviour extends Behavior
{
    public $balanceAttribute = 'balance';
    public $sliceAttribute = 'slice';

    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_INSERT => 'beforeSave',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'beforeSave',
            ActiveRecord::EVENT_AFTER_FIND => 'afterFind'
        ];
    }

    public function beforeSave(Event $event)
    {
        $model = $event->sender;

        $balance = $model->{$this->balanceAttribute};

        if (is_float($balance)) {
            list($intPart, $floatPart) = explode('.', (string)$balance);

            $model->{$this->balanceAttribute} = $intPart . $floatPart;
            $model->{$this->sliceAttribute} = iconv_strlen($floatPart);
        }
    }

    public function afterFind(Event $event)
    {
        $model = $event->sender;

        $balance = $model->{$this->balanceAttribute};
        $slice = $model->{$this->sliceAttribute};

        if ($slice > 0) {
            $model->{$this->balanceAttribute} = $balance / (int)('1' . str_repeat('0', $slice));
        }
    }
}