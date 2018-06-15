<?php

namespace app\components\schedulers\strategy\commissions;

use app\components\schedulers\strategy\StrategyInterface;
use app\models\Deposit;

class LowBalanceStrategy implements StrategyInterface
{
    public function canCalculate(Deposit $model): bool
    {
    }

    public function commit(Deposit $model)
    {
    }
}