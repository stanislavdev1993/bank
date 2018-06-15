<?php

namespace app\commands;

use app\components\schedulers\SchedulerInterface;
use yii\console\Controller;
use yii\console\ExitCode;

/**
 * Class DepositController
 * @package app\commands
 * @property SchedulerInterface $scheduler
 */
abstract class DepositController extends Controller
{
    protected $scheduler;

    public function actionCalculate()
    {
        $deposits = $this->getDeposits();

        $this->scheduler->calculate($deposits);

        return ExitCode::OK;
    }

    abstract protected function getDeposits(): array;
}