<?php
$this->breadcrumbs=array(
	'Группы'=>array('index'),
	'Экспорт групп',
);

$this->menu=array(

    array('label'=>'Список групп','url'=>array('index'),'icon'=>'list'),
	array('label'=>'Создать группу','url'=>array('create'),'icon'=>'plus'),
    array('label'=>'Импорт групп', 'url'=>array('import'),'icon'=>'download-alt'),


);
//echo '<pre>'.print_r($model).'</pre>';
?>

<div class="hero-unit">
  <h1>Экспорт групп</h1>
  <p>Все группы системы экспортированы и загружены на сервер
   его можно забрать по адресу <code><?php echo $path; ?></code> или воспользоваться кнопкой ниже
  </p>
  <p>
    <a href="<?php echo DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR.'UsersExport.xlsx';; ?>" class="btn btn-primary btn-large">
      Скачать
    </a>
  </p>
</div>

