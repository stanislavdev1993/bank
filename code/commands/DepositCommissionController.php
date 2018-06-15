<?php

namespace app\commands;

use app\models\Deposit;
use yii\base\Module;

class DepositCommissionController extends DepositController
{
    public function __construct(string $id, Module $module, array $config = [])
    {
        parent::__construct($id, $module, $config);

        $this->scheduler = \Yii::$app->depositCommission;
    }

    public function getDeposits(): array
    {
        return Deposit::find()->all();
    }
}