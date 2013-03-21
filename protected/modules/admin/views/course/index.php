<?php
$this->breadcrumbs=array(
	'Курсы'=>array('index'),
	'Список курсов',
);

$this->menu=array(
	array('label'=>'Список курсов','url'=>array('index'),'icon'=>'list'),
	array('label'=>'Создать курс','url'=>array('create'),'icon'=>'plus'),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('course-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h3>Список курсов</h3>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'course-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'group_id'=>array
        (
            'name'=>'group_id',
            'type'=>'raw',
            'value'=>'CHtml::link($data->groups->name,array("group/view?id=".$data->groups->id))',
            'filter'=>Group::all(),
        ),
		'subject'=>array
        (
            'name'=>'subject',
            'type'=>'raw',
            'value'=>'CHtml::link($data->subjects->name,array("subject/view?id=".$data->subjects->id))',
            'filter'=>Subject::all(),
        
        ),
		'teacher'=>array
        (
            'name'=>'teacher',
            'type'=>'raw',
            'value'=>'CHtml::link($data->users->realName,array("user/view?id=".$data->users->id))',
            'filter'=>User::allTeachers(),
        ),
		'default_point',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); 
?>


