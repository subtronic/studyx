<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
	<?php 
    echo $form->labelEx($model,'group_id');
    echo $form->dropDownList($model,'group_id',Group::all(),array('empty'=>''),array('class'=>'span5')); ?>

	<?php 
    echo $form->labelEx($model,'subject');
    echo $form->dropDownList($model,'subject',Subject::all(),array('empty'=>''),array('class'=>'span5')); ?>

	<?php 
    echo $form->labelEx($model,'teacher');
    echo $form->dropDownList($model,'teacher',User::allTeachers(),array('empty'=>''),array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'default_point',array('class'=>'span5')); ?>
    
    <?php 
    echo $form->labelEx($model,'allowAllView');
    echo $form->dropDownList($model,'allowAllView',array('0'=>'Нет','1'=>'Да'),array('empty'=>''),array('class'=>'span5'));?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Поиск',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
