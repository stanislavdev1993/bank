<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Deposit */
/* @var $clients array */

$this->title = 'Create Deposit';
$this->params['breadcrumbs'][] = ['label' => 'Deposits', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="deposit-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'clients' => $clients
    ]) ?>

</div>
