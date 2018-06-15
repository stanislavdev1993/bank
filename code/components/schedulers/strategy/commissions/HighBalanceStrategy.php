<?php

namespace app\components\schedulers\strategy\commissions;

use app\components\schedulers\strategy\StrategyInterface;
use yii\db\ActiveRecordInterface;

class HighBalanceStrategy implements StrategyInterface
{
    public function canCalculate(ActiveRecordInterface $model): bool
    {
        return true;
    }

    public function commit(ActiveRecordInterface $model)
    {
    }
}