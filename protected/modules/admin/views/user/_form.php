<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Поля с <span class="required">*</span> обязательны.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'login',array('class'=>'span5','maxlength'=>255)); ?>

   	<?php echo $form->textFieldRow($model,'passwd_nat',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'realName',array('class'=>'span5','maxlength'=>255)); ?>
    
	<?php 
    echo $form->labelEx($model,'role');
    echo $form->dropDownList($model,'role',array('user'=>'Студент','teacher'=>'Преподаватель','admin'=>'Администратор'),array('class'=>'span5',));//textFieldRow($model,'role',array('class'=>'span5','maxlength'=>7)); ?>

	<?php 
    echo $form->labelEx($model,'group_id');
    echo $form->dropDownList($model,'group_id', Group::all(),array('empty'=>''));//array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Создать' : 'Сохранить',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
