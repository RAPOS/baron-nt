<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\BFeedback */
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Обратная связь', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bfeedback-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'email:email',
            'name',
            'subject',
            'text:ntext',
			[
				'attribute' => 'date',
				'format' => ['date', 'php:d.m.Y']
			],
        ],
    ]) ?>
    <p>
        <?= Html::a('Ответить', ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Отмена', ['/admin/feedback'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить запись', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
</div>
