<?php

namespace app\components\schedulers;

use app\components\schedulers\strategy\percents\PercentStrategy;
use app\components\schedulers\strategy\StrategyInterface;
use app\models\Deposit;
use yii\base\Component;

/**
 * Class DepositPercent
 * @package app\components\schedulers
 * @property StrategyInterface $percentStrategy
 */
class DepositPercent extends Component implements SchedulerInterface
{
    protected $strategy;

    public function __construct(array $config = [])
    {
        parent::__construct($config);

        $this->strategy = new PercentStrategy();
    }

    public function calculate(array $deposits)
    {
        /* @var $deposit \app\models\Deposit */

        foreach ($deposits as $deposit) {
            if ($this->strategy->canCalculate($deposit)) {
                $this->strategy->commit($deposit);
            }
        }
    }
}