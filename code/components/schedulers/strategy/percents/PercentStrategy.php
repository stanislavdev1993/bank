<?php

namespace app\components\schedulers\strategy\percents;

use app\components\schedulers\strategy\StrategyInterface;
use app\models\Deposit;

class PercentStrategy implements StrategyInterface
{
    protected $historyModel;

    public function __construct($historyModel = null)
    {
        if ($historyModel == null) {
            $this->historyModel = '';
        }
    }

    public function canCalculate(Deposit $model): bool
    {

        $month = strtotime('+1 month', $model->created_at);

        $calcDay = date('d', $month);
        $calcMonth = date('m', $month);
        $calcYear = date('Y', $month);

        $currentDay = date('d', time());
        $currentMonth = date('m', time());
        $currentYear = date('Y', time());

        if ($calcDay <= $currentDay
            && $calcMonth == $currentMonth
            && $calcYear == $currentYear
        ) {
            return true;
        }

        return false;
    }

    public function commit(Deposit $model)
    {
        $model->balance += $this->getBalance($model->balance, $model->percent);

        $model->save();
    }

    public function getBalance($currentBalance, int $percent)
    {
        return $currentBalance * $percent / 100;
    }
}