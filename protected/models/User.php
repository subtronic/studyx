<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $login
 * @property string $password
 * @property string $realName
 * @property integer $role
 * @property integer $group_id
 */
class User extends CActiveRecord
{
    
    public $xls;    //путь до загружаемого файла
    public $action; //действие при импорте
    public $succes; //успех импорта
    public $defaultGroup_id; //Группа по умолчанию
    public $createNewGroup; //создавать ли новую группу
    public $defaultRole;  //Стандартная роль, если в файле импорта не была установлена
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('login, passwd_nat, realName, role', 'required'),
			array('group_id', 'numerical', 'integerOnly'=>true),
			array('login, passwd_nat, realName', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, login, passwd_nat, realName, role, group_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'group'=>array(self::BELONGS_TO,'Group','group_id'),
            'courses'=>array(self::HAS_MANY,'Course','id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'login' => 'Логин',
			'password' => 'Хеш пароля',
			'realName' => 'Имя',
			'role' => 'Роль',
			'group_id' => 'Группа',
            'passwd_nat' =>'Пароль'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('login',$this->login,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('realName',$this->realName,true);
		$criteria->compare('role',$this->role);
		$criteria->compare('group_id',$this->group_id);
        $criteria->compare('passwd_nat',$this->passwd_nat);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function beforeSave(){
            $this->password=md5($this->passwd_nat);
        return parent::beforeSave();
    }
    
    public static function allTeachers()
    {
        return $a = CHtml::listData(self::model()->findAll('role="teacher"'),'id','realName');    
    }
}