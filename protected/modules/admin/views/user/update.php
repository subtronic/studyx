<?php
$this->breadcrumbs=array(
	'Пользователи'=>array('index'),
	$model->realName=>array('view','id'=>$model->id),
	'Изменение',
);

$this->menu=array(
	array('label'=>'Список пользователей','url'=>array('index'),'icon'=>'list'),
	array('label'=>'Создать пользоватея', 'url'=>array('create'),'icon'=>'plus'),
	array('label'=>'Просмотр пользователя','url'=>array('view','id'=>$model->id),'icon'=>'eye-open'),
);
?>

<h3>Изменение пользователя <?php echo $model->realName; ?></h3>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>