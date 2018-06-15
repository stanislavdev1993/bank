<?php

namespace app\components\schedulers;

use app\components\schedulers\strategy\commissions\HighBalanceStrategy;
use app\components\schedulers\strategy\commissions\LowBalanceStrategy;
use app\components\schedulers\strategy\commissions\MiddleBalanceStrategy;
use app\components\schedulers\strategy\StrategyInterface;
use app\models\Deposit;
use yii\base\Component;

/**
 * Class DepositCommission
 * @package app\components\schedulers
 * @property StrategyInterface $strategy
 */
class DepositCommission extends Component implements SchedulerInterface
{
    protected $strategy;

    public function calculate(array $deposits)
    {
        foreach ($deposits as $deposit) {
            try {
                $this->setStrategy($deposit);
            } catch (\Exception $e) {
                echo $e->getMessage();
                exit;
            }

            if ($this->strategy->canCalculate($deposit)) {
                $this->strategy->commit($deposit);
            }
        }
    }

    protected function setStrategy(Deposit $deposit)
    {
        // TODO: refactoring
        if ($deposit->balance >= LowBalanceStrategy::COMMISSION_FROM
            && $deposit->balance <= LowBalanceStrategy::COMMISSION_TO
        ) {
            $this->strategy = new LowBalanceStrategy();
        } elseif ($deposit->balance >= MiddleBalanceStrategy::COMMISSION_FROM
            && $deposit->balance <= MiddleBalanceStrategy::COMMISSION_TO
        ) {
            $this->strategy = new MiddleBalanceStrategy();
        } elseif ($deposit->balance >= HighBalanceStrategy::COMMISSION_FROM) {
            $this->strategy = new HighBalanceStrategy();
        } else {
            throw new \Exception('Strategy not found');
        }
    }
}