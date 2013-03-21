<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'course-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Поля с <span class="required">*</span> обязательны.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php 
    echo $form->labelEx($model,'group_id');
    echo $form->dropDownList($model,'group_id',Group::all(),array('class'=>'span5')); ?>

	<?php 
    echo $form->labelEx($model,'subject');
    echo $form->dropDownList($model,'subject',Subject::all(),array('class'=>'span5')); ?>

	<?php 
    echo $form->labelEx($model,'teacher');
    echo $form->dropDownList($model,'teacher',User::allTeachers(),array('class'=>'span5'));?>

	<?php echo $form->textFieldRow($model,'default_point',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Создать' : 'Сохранить',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
