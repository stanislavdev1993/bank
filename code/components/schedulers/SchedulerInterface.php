<?php

namespace app\components\schedulers;

interface SchedulerInterface
{
    public function calculate(array $deposits);
}