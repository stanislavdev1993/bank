<?php

namespace app\components\schedulers\strategy\commissions;

use app\components\schedulers\strategy\StrategyInterface;
use yii\db\ActiveRecordInterface;

class MiddleBalanceStrategy implements StrategyInterface
{
    public function canCalculate(ActiveRecordInterface $model): bool
    {
    }

    public function commit(ActiveRecordInterface $model)
    {
    }
}