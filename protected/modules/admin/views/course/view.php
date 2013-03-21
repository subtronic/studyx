<?php
$this->breadcrumbs=array(
	'Курсы'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Спиоск курсов','url'=>array('index'),'icon'=>'list'),
	array('label'=>'Создать курс','url'=>array('create'),'icon'=>'plus'),
	array('label'=>'Изменить курс','url'=>array('update','id'=>$model->id),'icon'=>'pencil'),
	array('label'=>'Удалить курс','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы действительно хотите удалить выбранный курс?'),'icon'=>'trash'),
);
?>

<h3>Просмотр Курса #<?php echo $model->id; ?></h3>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'group_id'=>array  
        (
            'name'=>'group_id',
            'type'=>'raw',
            'value'=>CHtml::link($model->groups->name,array("group/view?id=".$model->groups->id)),
        ),
		'subject'=>array
        (
            'name'=>'subject',
            'type'=>'raw',
            'value'=>CHtml::link($model->subjects->name,array("subject/view?id=".$model->subjects->id)),
        ),
		'teacher'=>array
        (
            'name'=>'teacher',
            'type'=>'raw',
            'value'=>CHtml::link($model->users->realName,array("user/view?id=".$model->users->id)),
         ),
		'default_point',
	),
)); ?>
