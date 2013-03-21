<?php
$this->breadcrumbs=array(
	'Дисциплины'=>array('index'),
	'Список дисциплин',
);

$this->menu=array(
	array('label'=>'Список дисциплин','url'=>array('index'),'icon'=>'list'),
	array('label'=>'Создать дисциплину','url'=>array('create'),'icon'=>'plus'),
    array('label'=>'Импорт дисциплин','url'=>array('import'),'icon'=>'upload'),
    array('label'=>'Экспорт дисциплин','url'=>array('export'),'icon'=>'download-alt'),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('subject-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h3>Список дисциплин</h3>

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
	'id'=>'subject-grid',
    'type'=>'striped hover',  
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
