<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \app\models\Phones */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Edit';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please redact out the following fields:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'edit',
        'layout' => 'horizontal',
        //'action' => 'save',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
    <?= $form->field($model, 'prise')->textInput(['autofocus' => false]) ?>
    <?= $form->field($model, 'about')->textInput(['autofocus' => false]) ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'edit-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
