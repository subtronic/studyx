<?php
$this->breadcrumbs=array(
	'Пользователи'=>array('index'),
	$model->realName,
);

$this->menu=array(
	array('label'=>'Список пользователей','url'=>array('index'),'icon'=>'list'),
	array('label'=>'Создать пользоватея', 'url'=>array('create'),'icon'=>'plus'),
	array('label'=>'Изменить пользователя','url'=>array('update','id'=>$model->id),'icon'=>'pencil'),
	array('label'=>'Удалить пользователя','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы действительно хотите удалить выбраного пользователя?'),'icon'=>'trash'),
);
?>

<h3>Просмотр пользователя <?php echo $model->realName; ?></h3>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'login',
		'passwd_nat',
		'password',
		'realName',
        
		'role'=>array
        (
            'name'=>'role',
            'value'=>($model->role=="admin" ? "Администратор":($model->role=="teacher" ?"Преподаватель":"Студент")),
        ),
        
		'group_id'=>array
        (
            'name'=>'group_id',
            'type'=>'raw',
            'value'=>CHtml::link(CHtml::encode($model->group->name),
                                 array('group/view','id'=>$model->group_id)),
        ),

	),
    
)); 
?>
