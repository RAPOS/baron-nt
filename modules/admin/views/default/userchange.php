<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\BAdmins */
/* @var $form ActiveForm */
?>
<div class="admin-default-userchange">
	<h1>Изменить данные</h1>
    <?php $form = ActiveForm::begin([
		'id' => 'userchange-form',
		'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
	]); ?>

        <?= $form->field($model, 'name')->input('text', ['value' => ''])->label('Введите новый логин:')?>
        <?= $form->field($model, 'password')->passwordInput(['value' => ''])->label('Введите новый пароль:')?>
    
        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
            <?= Html::Button('Отменить', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- admin-default-login -->