<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'group_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'subject',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'teacher',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'default_point',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Поиск',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
