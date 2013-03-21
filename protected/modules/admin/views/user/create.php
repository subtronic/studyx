<?php
$this->breadcrumbs=array(
	'Пользователи'=>array('index'),
	'Создать',
);

$this->menu=array(
	array('label'=>'Список пользователей','url'=>array('index'),'icon'=>'list'),
);
?>

<h3>Создание пользователяr</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>