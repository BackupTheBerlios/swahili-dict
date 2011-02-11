<?php

class sw_grammatik extends CActiveRecord {
    /**
     * The followings are the available columns in the table:
     * @var integer $id
     * @var string $bezeichnung
     * @var string $kurz
     */


    /**
     * Returns the static model of the specified AR class.
     * @return CActiveRecord the static model class
     */
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'sw_grammatik';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
                array('bezeichnung, kurz', 'required', 'message'=>'"{attribute}" darf nicht leer sein.'),
        );
    }


    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
                'id' => 'Id',
                'bezeichnung' => 'Kategorie',
                'kurz' => 'Kurzbezeichnung',
        );
    }

}