<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\BTypesOfMassage */

$this->params['breadcrumbs'][] = ['label' => 'Программы', 'url' => ['/admin/programs']];
$this->params['breadcrumbs'][] = $model->name;
?>
<div class="btypes-of-massage-view">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id_massage], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id_massage], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удлаить?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_massage',
            'name',
            'translate',
            'description:ntext',
            'duration',
            'keywords',
            'images:ntext',
        ],
    ]) ?>
</div>
