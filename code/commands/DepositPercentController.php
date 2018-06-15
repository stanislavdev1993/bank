<?php

namespace app\commands;

use app\models\Deposit;
use yii\base\Module;

class DepositPercentController extends DepositController
{
    public function __construct(string $id, Module $module, array $config = [])
    {
        parent::__construct($id, $module, $config);

        $this->scheduler = \Yii::$app->depositPercent;
    }

    public function getDeposits(): array
    {
        return Deposit::find()->all();
    }
}