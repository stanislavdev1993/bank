<?php

namespace app\components\schedulers\strategy;

use app\models\Deposit;

interface StrategyInterface
{
    public function canCalculate(Deposit $model):bool;
    public function commit(Deposit $model);
}