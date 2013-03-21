<?php

class UserController extends Controller
{
    const ROLE_ADMIN = 'admin';
    const ROLE_MODER = 'teacher';
    const ROLE_USER = 'user';
    const ROLE_BANNED = 'banned';
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='/layouts/column2';
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('admin','index','view','create','update','import','export','delete'),
				'roles'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

    
    /**
	 * Displays export for system users.
	 */
public function actionExport()
	{

    $objPHPExcel = Yii::app()->yexcel->activate();
    
    //$file_path=Yii::app()->getModule('admin')->getBasePath().'\views\group\files\Groupexport.xlsx';

    $objPHPExcel->getProperties()->setCreator("Site");
    $objPHPExcel->getProperties()->setLastModifiedBy("Site");
    $objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
    $objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
    $objPHPExcel->getProperties()->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.");
    
    

    $mod=User::model()->findAll(true);
    
    $objPHPExcel->setActiveSheetIndex(0);
    $i=2;
    $objPHPExcel->getActiveSheet()->SetCellValue("A1", 'Логин');
    $objPHPExcel->getActiveSheet()->SetCellValue("B1", 'Пароль');
    $objPHPExcel->getActiveSheet()->SetCellValue("C1", 'ФИО');
    $objPHPExcel->getActiveSheet()->SetCellValue("D1", 'Роль');
    $objPHPExcel->getActiveSheet()->SetCellValue("E1", 'Группа(если студент)');
    
    foreach($mod as $m)
    {
       $objPHPExcel->getActiveSheet()->SetCellValue("A$i", $m->login);
       $objPHPExcel->getActiveSheet()->SetCellValue("B$i", $m->passwd_nat);
       $objPHPExcel->getActiveSheet()->SetCellValue("C$i", $m->realName);
       
            switch ($m->role) {
                            case 'admin':
                                $rl='Администратор';
                                break;
                            case 'teacher':
                                $rl='Преподаватель';
                                break;
                            case 'user':
                                $rl='Студент';
                                break;
                            default:
                                $rl='Студент';
                                break;
                        }
       $objPHPExcel->getActiveSheet()->SetCellValue("D$i", $rl);
       
       $mdl=Group::model()->find('id=:id',array(':id'=>$m->group_id));
       
       $objPHPExcel->getActiveSheet()->SetCellValue("E$i", $mdl->name);
       $i++; 
    }

    $objPHPExcel->getActiveSheet()->setTitle('Экспорт пользователей');
    
    		
    $path=getcwd().DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR.'UsersExport.xlsx';
    $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
    $objWriter->save($path);
    
		$this->render('export',array(
			'model'=>$model,'path'=>$path,
		));
	}
    
    /**
	 * Displays import for system users.
	 */
	public function actionImport()
	{
	   $model=new User;
        if(isset($_POST['User'])AND(CUploadedFile::getInstance($model,'xls')<>'')){
            
            $model->attributes=$_POST['User'];
            $model->xls=CUploadedFile::getInstance($model,'xls');
            $model->action=$_POST['User']['action'];
            $model->defaultGroup_id=$_POST['User']['defaultGroup_id'];
            $model->createNewGroup=$_POST['User']['createNewGroup'];
            $model->defaultRole=$_POST['User']['defaultRole'];
            
            $path=Yii::app()->getModule('admin')->getBasePath().DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'user'.DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR.''.$model->xls;
            
            if(Yii::app()->file->set($path)->exists){
                Yii::app()->file->set($path)->delete();
             }
                //echo $path;
                $model->xls->saveAs($path);
                // перенаправляем на страницу, где выводим сообщение об
                // успешной загрузке
            //}
        //$file_path=dirname(__FILE__) . '/files/1.xlsx';
        $sheet_array = Yii::app()->yexcel->readActiveSheet($path);     
        $cnt++;
        $j=2;
        while(true){
            if (($sheet_array[$j]['A']<>'')||($sheet_array[$j]['C']<>'')){
               if ($model->action==0){
                   if(User::model()->count('login=:lg',array(':lg'=>$sheet_array[$j]['A']))<>0) {$j++;continue;} 
                   if(User::model()->count('realName=:lg',array(':lg'=>$sheet_array[$j]['C']))<>0) {$j++;continue;}
                   
                   $mdl=new User;
                   
                   //Обработка логина
                   if ($sheet_array[$j]['A']<>''){
                        $login=$sheet_array[$j]['A'];
                   } else {
                        $login=strtolower(Helper::translitIt($sheet_array[$j]['C']));
                        $pos=strpos($login, '_');
                        if($pos<>0)$login=substr($login,0,$pos);
                   }
                   $lg=$login;
                   while(true){
                        if(User::model()->count('login=:lg',array(':lg'=>$lg))<>0){
                            $lg=$login.(string)rand(0,100);
                        } else {
                            $mdl->login=$lg;
                            break;
                        }
                   }
                   
                   //Обработка пароля
                   if($sheet_array[$j]['B']<>''){
                        $mdl->passwd_nat=$sheet_array[$j]['B'];
                   } else {
                        $mdl->passwd_nat=Helper::generate_password(5);
                   }
                   
                   //Обработка  имени
                   if (User::model()->count('realName=:lg',array(':lg'=>$sheet_array[$j]['C']))>0)
                   { 
                       break;
                   } else{
                        $mdl->realName=$sheet_array[$j]['C'];
                   }
                   
                   //Обработка роли
                   if ($sheet_array[$j]['D']<>''){
                       switch ($sheet_array[$j]['D']) {
                            case 'Администратор':
                                $mdl->role='admin';
                                break;
                            case 'Преподаватель':
                                $mdl->role='teacher';
                                break;
                            case 'Студент':
                                $mdl->role='user';
                                break;
                            default:
                                $mdl->role='user';
                                break;
                        }
                    } else {
                        if($model->defaultRole<>'')
                        {
                            $mdl->role=$model->defaultRole;
                        } else {
                            $mdl->role='user';
                        }
                    }
                    //Обработка группы
                    if($sheet_array[$j]['E']<>''){
                        $m=Group::model()->find('name=:nm',array(':nm'=>$sheet_array[$j]['E']));
                        if(isset($m->id))
                        {
                            $mdl->group_id=$m->id;
                        } else {
                            if ($model->createNewGroup==1){
                                $gr=new Group;
                                $gr->name=$sheet_array[$j]['E'];
                                $gr->save();
                                $m=Group::model()->find('name=:nm',array(':nm'=>$sheet_array[$j]['E']));
                                $mdl->group_id=$m->id;
                            } else {
                                $mdl->group_id=0;
                            }
                        }
                    
                    } else {
                        if($model->defaultGroup_id<>'')
                        {
                            $mdl->group_id=$model->defaultGroup_id;    
                        } else {$mdl->group_id=0;}
                    }
                    
                    if($mdl->save()){$cnt++;};
            } else {
                if($model->action==1)
                {
                     if(User::model()->count('login=:lg',array(':lg'=>$sheet_array[$j]['A']))>0) 
                     {
                        $dl=User::model()->findByAttributes(array('login'=>$sheet_array[$j]['A']));
                        if($dl->delete())$cnt++;
                     }
                     if(User::model()->count('realName=:nm',array(':nm'=>$sheet_array[$j]['C']))>0) 
                     {
                        $dl=User::model()->findByAttributes(array('realName'=>$sheet_array[$j]['C']));
                        if($dl->delete())$cnt++;
                     }  
                
                }
            }
            $j++;
            } else {
                break;
            
            }
        }   
                
        
        $model->succes=$cnt;
        } 

		$this->render('import',array(
			'model'=>$model,
		));
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

/**
 * This action for import into system form excell file users data
 * @param integer $id the ID of the model to be displayes
 */


	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new User;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$model=new User('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['User']))
			$model->attributes=$_GET['User'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return User the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param User $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
