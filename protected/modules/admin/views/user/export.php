<?php
$this->breadcrumbs=array(
	'Пользователи'=>array('index'),
	'Экспорт пользователей',
);

$this->menu=array(

    array('label'=>'Список пользователей','url'=>array('index'),'icon'=>'list'),
	array('label'=>'Создать пользователя','url'=>array('create'),'icon'=>'plus'),
    array('label'=>'Импорт пользователей', 'url'=>array('import'),'icon'=>'download-alt'),


);
//echo '<pre>'.print_r($model).'</pre>';
?>

<div class="hero-unit">
  <h1>Экспорт пользователей</h1>
  <p>Все группы системы экспортированы и загружены на сервер в формате Excell
  Вы можете забрать файл здесь - <code><?php echo $path; ?></code><br />
  Или воспользоваться кнопкой ниже.
  </p>
  <p>
    <a href="<?php echo DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR.'UsersExport.xlsx'; ?>" class="btn btn-primary btn-large">
      Скачать
    </a>
  </p>
</div>


