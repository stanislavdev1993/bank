<?php

namespace app\components\schedulers;

use yii\base\Component;

class DepositCommission extends Component implements SchedulerInterface
{
    protected $commissionStrategy;

    public function calculate(array $deposits)
    {
        exit('FSS');
    }
}