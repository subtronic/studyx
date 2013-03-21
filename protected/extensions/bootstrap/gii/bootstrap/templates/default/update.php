<?php
/**
 * The following variables are available in this template:
 * - $this: the BootCrudCode object
 */
?>
<?php
echo "<?php\n";
$nameColumn=$this->guessNameColumn($this->tableSchema->columns);
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	'$label'=>array('index'),
	\$model->{$nameColumn}=>array('view','id'=>\$model->{$this->tableSchema->primaryKey}),
	'Изменить',
);\n";
?>

$this->menu=array(
	array('label'=>'Список <?php echo $this->modelClass; ?>','url'=>array('index'),'icon'=>'list'),
	array('label'=>'Создать <?php echo $this->modelClass; ?>','url'=>array('create'),'icon'=>'plus'),
	array('label'=>'Просмотр <?php echo $this->modelClass; ?>','url'=>array('view','id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>),'icon'=>'eye-open'),
);
?>

<h3>Изменение <?php echo $this->modelClass." <?php echo \$model->{$this->tableSchema->primaryKey}; ?>"; ?></h3>

<?php echo "<?php echo \$this->renderPartial('_form',array('model'=>\$model)); ?>"; ?>