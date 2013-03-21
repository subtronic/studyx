<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Пользователи'=>array('index'),
	'Список пользователей',
);

$this->menu=array(
	array('label'=>'Создать пользоватея', 'url'=>array('create'),'icon'=>'plus'),
    array('label'=>'Импорт пользователей', 'url'=>array('import'),'icon'=>'upload'),
    array('label'=>'Экспорт пользователей', 'url'=>array('export'),'icon'=>'download-alt'),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#user-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h3>Управление пользователями</h3>

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

<?php

 $this->widget('bootstrap.widgets.TBGridView', array(
	'id'=>'user-grid',
	'type'=>'striped hover',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'summaryText'=>'Пользователи {start}-{end} из {count} .',
	'columns'=>array(
		'id' =>array(
            'name'=>'id',
            'headerHtmlOptions'=>array('width'=>40),
        ),
		'login',
        'passwd_nat',
		'realName',
		'role'=>array(
            'name'=>'role',
            'filter'=>array('admin'=>'Администратор','teacher'=>'Преподаватель','user'=>'Студент',),
            'value'=>'($data->role=="admin" ? "Администратор":($data->role=="teacher" ?"Преподаватель":"Студент"))',
        ),
		'group_id'=>array(
            'name'=>'group_id',
            'type'=>'raw',
            'value'=>'CHtml::link($data->group->name,array("group/view?id=".$data->group->id))',
            'filter'=>Group::all(),
        ),
        array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
