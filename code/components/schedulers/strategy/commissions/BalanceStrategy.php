<?php

namespace app\components\schedulers\strategy\commissions;

use app\components\schedulers\strategy\StrategyInterface;
use app\models\Deposit;
use app\models\DepositHistory;

class BalanceStrategy implements StrategyInterface
{
    const COMMISSION_FROM = 0;
    const COMMISSION_TO = 10;
    const COMMISSION_PERCENT = 1;
    const COMMISSION_MIN_VALUE = 1;

    public function canCalculate(Deposit $model): bool
    {
        return true;
        $currentDay = date('d', time());

        return $currentDay == 1;
    }

    public function commit(Deposit $model)
    {
        $model->balance = $model->balance - $this->getBalance(
            $model->balance,
            static::COMMISSION_PERCENT,
            $model->created_at
        );

        if ($model->save()) {
            $this->saveHistory($model);
        }
    }

    protected function saveHistory(Deposit $model)
    {
        $historyModel = new DepositHistory([
            'client_id' => $model->client_id,
            'deposit_id' => $model->id,
            'type' => DepositHistory::TYPE_COMMISSION,
            'value' => $model->balance,
        ]);

        $historyModel->save();
    }

    protected function getBalance($currentBalance, int $commission, $createdAt)
    {
        $balanceCommission = $currentBalance * $commission / 100;

        if ($balanceCommission < static::COMMISSION_MIN_VALUE) {
            $balanceCommission = static::COMMISSION_MIN_VALUE;
        }

        $createdMonth = date('m', $createdAt);
        $createdDay = date('d', $createdAt);
        $currentMonth = date('m', time());

        if ($currentMonth - $createdMonth == 1 || $currentMonth - $createdMonth == - 1) {
            $balanceCommission = $balanceCommission * 1 / $createdDay;
        }

        return $balanceCommission;
    }
}