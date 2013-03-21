<?php
/**
 * The following variables are available in this template:
 * - $this: the BootCrudCode object
 */
?>
<?php
echo "<?php\n";
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	'$label'=>array('index'),
	'Создать',
);\n";
?>

$this->menu=array(
	array('label'=>'Список <?php echo $this->modelClass; ?>','url'=>array('index'),'icon'=>'plus'),
);
?>

<h3>Создание <?php echo $this->modelClass; ?></h3>

<?php echo "<?php echo \$this->renderPartial('_form', array('model'=>\$model)); ?>"; ?>
