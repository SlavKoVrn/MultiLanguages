<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $model Item */
?>
<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'name'); ?>

<?php foreach ($model->getVariationModels() as $index => $variationModel): ?>
    <?= $form->field($variationModel, "[{$index}]title")->label($variationModel->getAttributeLabel('title') . ' (' . $variationModel->language_id . ')'); ?>
    <?= $form->field($variationModel, "[{$index}]description")->textarea([
        'rows'=>6
    ])->label($variationModel->getAttributeLabel('description') . ' (' . $variationModel->language_id . ')'); ?>
<?php endforeach; ?>

<div class="form-group">
    <?= Html::submitButton(Yii::t('item','Save'), ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>
