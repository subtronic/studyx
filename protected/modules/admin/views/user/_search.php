<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'login',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'realName',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'role',array('class'=>'span5','maxlength'=>7)); ?>

	<?php echo $form->textFieldRow($model,'group_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'passwd_nat',array('class'=>'span5','maxlength'=>255)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Поиск',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
