<?php

namespace app\components\schedulers\strategy\percents;

use app\components\schedulers\strategy\StrategyInterface;
use app\models\Deposit;
use app\models\DepositHistory;

class PercentStrategy implements StrategyInterface
{
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

        if ($model->save()) {
            $this->saveHistory($model);
        }
    }

    protected function saveHistory(Deposit $model)
    {
        $historyModel = new DepositHistory([
            'client_id' => $model->client_id,
            'deposit_id' => $model->id,
            'type' => DepositHistory::TYPE_PERCENT,
            'value' => $model->balance,
        ]);

        $historyModel->save();
    }

    protected function getBalance($currentBalance, int $percent)
    {
        return $currentBalance * $percent / 100;
    }
}