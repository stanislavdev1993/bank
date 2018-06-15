<?php

namespace app\components\schedulers\strategy\commissions;

class LowBalanceStrategy extends BalanceStrategy
{
    const COMMISSION_FROM = 0;
    const COMMISSION_TO = 1000;
    const COMMISSION_PERCENT = 5;
    const COMMISSION_MIN_VALUE = 50;
}