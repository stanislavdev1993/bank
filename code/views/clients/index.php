<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Client;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Clients';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Client', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'surname',
            'name',
            [
                'attribute' => 'gender',
                'value' => function ($model) {
                    return $model->gender == Client::GENDER_MALE ? 'Male' : 'Female';
                }
            ],
            'birthday',

            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                        'create_deposit' => function () {
                            return Html::a(Html::tag('span', '',
                                ['class' => 'glyphicon glyphicon-piggy-bank']
                            ), '#');
                        }
                ],
                'template' => '{view} {update} {create_deposit} {delete} '
            ],
        ],
    ]); ?>
</div>
