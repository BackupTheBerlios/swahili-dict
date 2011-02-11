<?php

class klassen extends CActiveRecord {
    /**
     * The followings are the available columns in table 'klassen':
     * @var integer $sort
     * @var string $klasse_standard //primärschlüssel
     * @var integer $numerus // 1=Singular, 2=Plural, 3=Singular/Plural
     * @var string $klasse_neu
     * @var string $name
     * @var string $klassenpraefix
     * @var string $praefix_konsonant
     * @var string $praefix_vokal
     * @var string $subjekt
     * @var string $objekt
     * @var string $genetiv
     * @var string $possessiv
     * @var string $demonstrativ_nah
     * @var string $demonstrativ_fern
     * @var string $demonstrativ_ref
     * @var string $relativ_pron
     * @var string $indef_pron
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
        return 'klassen';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
                array('klasse_standard', 'required', 'message'=>'"{attribute}" darf nicht leer sein.'),
                array('klasse_neu, name, klassenpraefix, praefix_konsonant, praefix_vokal, subjekt, objekt, genetiv, possessiv, demonstrativ_nah, demonstrativ_fern, demonstrativ_ref, relativ_pron, indef_pron', 'type'), //type defaults to 'string'
                array('numerus', 'type'=>'integer'),
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
                'id' => 'Sort',
                'klasse_standard' => 'Klasse',
                'numerus' => 'Numerus',
                'klasse_neu' => 'Klasse (neu)',
                'name' => 'Klassenname',
                'klassenpraefix' => 'Klassenpräfix',
                'praefix_konsonant' => 'Präfix v. Kons.',
                'praefix_vokal' => 'Präfix v. Vokal',
                'subjekt' => 'Subjekt-Präfix',
                'objekt' => 'Objekt-Infix',
                'genetiv' => 'Genetiv (von)',
                'possessiv' => 'Possessivpron.',
                'demonstrativ_nah' => 'Dem.-Pron. (nah)',
                'demonstrativ_fern' => 'Dem.-Pron. (fern)',
                'demonstrativ_ref' => 'Dem.-Pron. (ref.)',
                'relativ_pron' => 'Relativpron.',
                'indef_pron' => 'Indefinitpron.',
        );
    }

}