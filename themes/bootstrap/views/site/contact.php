<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form TbActiveForm */

$this->pageTitle=Yii::app()->name . ' - Обратная связь';
$this->breadcrumbs=array(
	'Обратная связь',
);
?>

<h1>Напишите Нам!</h1>

<?php if(Yii::app()->user->hasFlash('contact')): ?>

    <?php $this->widget('bootstrap.widgets.TbAlert', array(
        'alerts'=>array('contact'),
    )); ?>

<?php else: ?>

<p>
Если Вы хотите связаться с разработчиком, то пожалуйста заполните форму ниже. Спасибо!
</p>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'contact-form',
    'type'=>'horizontal',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Поля с <span class="required">*</span> обязательны.</p>

	<?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldRow($model,'name',array('placeholder'=>'Сидоров Сергей Викторович')); ?>

    <?php echo $form->textFieldRow($model,'email',array('placeholder'=>'somemail@gmail.com')); ?>

    <?php echo $form->textFieldRow($model,'subject',array('size'=>60,'maxlength'=>128,'placeholder'=>'Благодарность')); ?>

    <?php echo $form->textAreaRow($model,'body',array('rows'=>6, 'class'=>'span8','placeholder'=>'Введите сюда текст письма...')); ?>

	<?php if(CCaptcha::checkRequirements()): ?>
		<?php echo $form->captchaRow($model,'verifyCode',array(
            'hint'=>'Пожалуйста, введите в поле букву, которые Вы видите на картинке выше.<br/>Буквы не чувствительны к регистру..',
        )); ?>
	<?php endif; ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton',array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>'Отправить',
        )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php endif; ?>