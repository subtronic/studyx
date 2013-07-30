<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('group')); ?>:</b>
	<?php echo CHtml::encode($data->group); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subject')); ?>:</b>
	<?php echo CHtml::encode($data->subject); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('teacher')); ?>:</b>
	<?php echo CHtml::encode($data->teacher); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('default_point')); ?>:</b>
	<?php echo CHtml::encode($data->default_point); ?>
    
    	<b><?php echo CHtml::encode($data->getAttributeLabel('allowAllView')); ?>:</b>
	<?php echo CHtml::encode($data->allowAllView); ?>


</div>