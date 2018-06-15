<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DepositHistory */

$this->title = 'Create Deposit History';
$this->params['breadcrumbs'][] = ['label' => 'Deposit Histories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="deposit-history-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
