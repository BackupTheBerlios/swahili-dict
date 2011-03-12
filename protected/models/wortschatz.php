<?php

class wortschatz extends CActiveRecord {
    /**
     * The followings are the available columns in table 'wortschatz':
     * @var integer $id
     * @var string $timestamp
     * @var string $kiswahili
     * @var integer $sw_grammatik_id
     * @var integer $sw_fachgebiet_id
     * @var integer $sw_gebrauch_id
     * @var integer $sw_region_id
     * @var string $deutsch
     * @var string $deutsch_addition
     * @var integer $wortart_id
     * @var integer $herkunft_id
     * @var string $noun_class
     * @var integer $noun_animate
     * @var string $noun_singular_swahili
     * @var integer $noun_class_singular
     * @var string $noun_plural_swahili
     * @var integer $noun_class_plural
     * @var string $noun_plural_deutsch
     * @var integer $verb_monosyllabic
     * @var string $verb_stem
     * @var string $verb_infinitive
     * @var string $kategorien
     * @var integer $kategorie_id
     * @var string $anmerkung
     * @var integer $grundwortschatz
     * @var string $author
     * @var string $link
     * @var string $quelle
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
        return 'wortschatz';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            array('noun_class', 'length', 'max' => 5),
            array('kiswahili, deutsch, wortart_id', 'required', 'message' => '"{attribute}" darf nicht leer sein.'),
            array('id, herkunft_id, sw_grammatik_id, sw_fachgebiet_id, sw_gebrauch_id, sw_region_id, noun_animate, noun_class_singular, noun_class_plural, verb_monosyllabic, kategorie_id, grundwortschatz', 'numerical', 'integerOnly' => true),
            array('deutsch_addition, noun_singular_swahili, noun_plural_swahili, noun_plural_deutsch, verb_stem, verb_infinitive, kategorien, anmerkung, author, link, quelle', 'type'), //type defaults to 'string'
            array('deutsch', 'validateDublicates', 'on' => 'create, copy'),
            array('noun_class', 'exist', 'attributeName' => 'klasse_standard', 'className' => 'klassen'),
        );
    }

    /**
     * The validation methods which are declared in rules().
     */
    public function validateDublicates($attribute, $params) {
        $criteria = new CDbCriteria;
        $criteria->condition = "(kiswahili='$this->kiswahili' AND deutsch='$this->deutsch')";

        $models = $this->findAll($criteria);
        $count = $this->count($criteria);
        if ($count > 0) {
            $this->addError('kiswahili', NULL);
            $this->addError('deutsch', 'Begriffspaar "' . $this->kiswahili . '/' . $this->deutsch . '" schon vorhanden');
        }
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'sw_grammatik_rel' => array(self::BELONGS_TO, 'sw_grammatik', 'sw_grammatik_id'),
            'sw_fachgebiet_rel' => array(self::BELONGS_TO, 'sw_fachgebiet', 'sw_fachgebiet_id'),
            'sw_gebrauch_rel' => array(self::BELONGS_TO, 'sw_gebrauch', 'sw_gebrauch_id'),
            'sw_region_rel' => array(self::BELONGS_TO, 'sw_region', 'sw_region_id'),
            'wortart_rel' => array(self::BELONGS_TO, 'wortarten', 'wortart_id'),
            'herkunft_rel' => array(self::BELONGS_TO, 'herkunft', 'herkunft_id'),
            'kategorie_rel' => array(self::BELONGS_TO, 'kategorien', 'kategorie_id'),
            'klasse_rel' => array(self::BELONGS_TO, 'klassen', 'noun_class'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'Id',
            'timestamp' => 'Timestamp',
            'kiswahili' => 'Kiswahili',
            'sw_grammatik_id' => 'Grammatik',
            'sw_fachgebiet_id' => 'Fachgebiet',
            'sw_gebrauch_id' => 'Gebrauch',
            'sw_region_id' => 'Region',
            'deutsch' => 'Deutsch',
            'deutsch_addition' => 'Zusatz de',
            'wortart_id' => 'Wortart',
            'herkunft_id' => 'Herkunft',
            'noun_class' => 'Klasse',
            'noun_animate' => 'Animate',
            'noun_singular_swahili' => 'Singular Kiswahili',
            'noun_class_singular' => 'Klasse Singular',
            'noun_plural_swahili' => 'Plural Kiswahili',
            'noun_class_plural' => 'Klasse Plural',
            'noun_plural_deutsch' => 'Plural Deutsch',
            'verb_monosyllabic' => 'Einsilbig',
            'verb_stem' => 'Verbstamm',
            'verb_infinitive' => 'Infinitiv',
            'kategorien' => 'Kategorien',
            'kategorie_id' => 'Thema',
            'anmerkung' => 'Anmerkung',
            'grundwortschatz' => 'Grundwortschatz',
            'author' => 'Autor',
            'link' => 'siehe auch',
            'quelle' => 'Quelle'
        );
    }

    protected function beforeSave() {
        if (parent::beforeSave()) {

            //prepare nouns
            if ($this->noun_class != "") {
                $class_array = explode('/', $this->noun_class);
                $class_count = count($class_array);
                $sing_classes = "1 3 5 7 9 11 15 16 17 18";
                $plur_classes = "2 4 6 8 10";

                if ($class_count == 2) {
                    $this->noun_class_singular = $class_array[0];
                    $this->noun_class_plural = $class_array[1];
                } elseif ($class_count == 1) {
                    if (stristr($sing_classes, $class_array[0]) == TRUE) {
                        $this->noun_class_singular = $class_array[0];
                        $this->noun_class_plural = "";
                    } elseif (stristr($plur_classes, $class_array[0]) == TRUE) {
                        $this->noun_class_plural = $class_array[0];
                        $this->noun_class_singular = "";
                    }
                }
            } else {
                $this->noun_class_plural = "";
                $this->noun_class_singular = "";
            }

            //if not noun:
            if ($this->wortart_id != '1') {
                $this->noun_class = "";
                $this->noun_animate = "";
                $this->noun_singular_swahili = "";
                $this->noun_class_singular = "";
                $this->noun_plural_swahili = "";
                $this->noun_class_plural = "";
                $this->noun_plural_deutsch = "";
            }

            //prepare verbs
            if ($this->wortart_id == '2') {
                $this->verb_stem = trim($this->kiswahili, '- ');
                $this->verb_infinitive = 'ku' . trim($this->kiswahili, '- ');
            }
            //if not verb:
            if ($this->wortart_id != '2') {
                $this->verb_monosyllabic = "";
                $this->verb_stem = "";
                $this->verb_infinitive = "";
            }

            //prepare examples and terms
            if ($this->wortart_id == '4' OR $this->wortart_id == '5') {
                $this->herkunft_id = 0;
            }
            return true;
        }
        else
            return false;
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->order = "TRIM(LEADING 'a ' FROM (TRIM(LEADING '-' FROM kiswahili))), wortart_id";

        $criteria->compare('id', $this->id);
        $criteria->compare('timestamp', $this->timestamp, true);
        $criteria->compare('kiswahili', $this->kiswahili, true);
        $criteria->compare('sw_grammatik_id', $this->sw_grammatik_id, true);
        $criteria->compare('sw_fachgebiet_id', $this->sw_fachgebiet_id, true);
        $criteria->compare('sw_gebrauch_id', $this->sw_gebrauch_id, true);
        $criteria->compare('sw_region_id', $this->sw_region_id, true);
        $criteria->compare('deutsch', $this->deutsch, true);
        $criteria->compare('deutsch_addition', $this->deutsch_addition, true);
        $criteria->compare('wortart_id', $this->wortart_id, true);
        $criteria->compare('herkunft_id', $this->herkunft_id, true);
        $criteria->compare('noun_class', $this->noun_class, true);
        $criteria->compare('noun_animate', $this->noun_animate);
        $criteria->compare('noun_singular_swahili', $this->noun_singular_swahili, true);
        $criteria->compare('noun_class_singular', $this->noun_class_singular);
        $criteria->compare('noun_plural_swahili', $this->noun_plural_swahili, true);
        $criteria->compare('noun_class_plural', $this->noun_class_plural);
        $criteria->compare('noun_plural_deutsch', $this->noun_plural_deutsch, true);
        $criteria->compare('verb_monosyllabic', $this->verb_monosyllabic);
        $criteria->compare('verb_stem', $this->verb_stem, true);
        $criteria->compare('verb_infinitive', $this->verb_infinitive, true);
        $criteria->compare('kategorien', $this->kategorien, true);
        $criteria->compare('kategorie_id', $this->kategorie_id, true);
        $criteria->compare('anmerkung', $this->anmerkung, true);
        $criteria->compare('grundwortschatz', $this->grundwortschatz);
        $criteria->compare('author', $this->author);
        $criteria->compare('link', $this->link);
        $criteria->compare('quelle', $this->quelle);

        return new CActiveDataProvider('wortschatz', array(
            'criteria' => $criteria,
        ));
    }

     /**
     * Returns some statistics about the dictionary.
     * @return array
     */
    public function statistics() {
        $countAll = $this->count();

        $kiswahili = new CDbCriteria;
        $kiswahili->condition = 'wortart_id!=4 AND wortart_id!=5'; //keine Beispiele und Ausdrücke
        $kiswahili->select = 'kiswahili';
        $kiswahili->group = 'kiswahili';
        $countKiswahili = count($this->findAll($kiswahili));

        $deutsch = new CDbCriteria;
        $deutsch->condition = 'wortart_id!=4 AND wortart_id!=5'; //keine Beispiele und Ausdrücke
        $deutsch->select = 'deutsch';
        $deutsch->group = 'deutsch';
        $countDeutsch = count($this->findAll($deutsch));

        $beispiele = new CDbCriteria;
        $beispiele->condition = 'wortart_id=4 OR wortart_id=5'; //nur Beispiele und Ausdrücke
        $countBeispiele = count($this->findAll($beispiele));

        return array(
            'countAll' => $countAll,
            'countKiswahili' => $countKiswahili,
            'countDeutsch' => $countDeutsch,
            'countBeispiele' => $countBeispiele,
        );
    }

    /**
     * More search functions used for the main dictionary search
     * Retrieve lists of models based on the search/filter conditions and different calculations
     */
    public function filterSearchOptions($kategorie='', $wortart='', $klasse='') {
        $criteria = new CDbCriteria;
        $criteria->with = array(// vorhandene Relationen in die Query einbeziehen (JOIN) als 'eager loading'
            'wortart_rel',
            'kategorie_rel',
        );

        if ($wortart != '') {
            $condition = " (wortart_rel.bezeichnung = '$wortart')";
        }
        if ($kategorie != '') {
            $condition .=" AND (kategorie_rel.bezeichnung = '$kategorie')";
        }
        if ($kategorie != '') {
            $condition .=" AND (klasse_rel.bezeichnung = '$klasse')";
        }
        $criteria->condition = $condition;

        $models = $this->findAll($criteria);

        return array(
            'models' => $models,
        );
    }

    /**
     * Trims the content of a given column and returns a part of a SQL statment.
     * @params string Name of the column that should be trimmed
     * @return string Part of SQL statement (e.g. for SELECT clause)
     */
    public function trimSQL($column) {
        $statement = "TRIM($column)"; //erste Zeile

        $statement = "TRIM(TRAILING '!' FROM ($statement))";
        $statement = "TRIM(TRAILING '?' FROM ($statement))";
        $statement = "TRIM(TRAILING '.' FROM ($statement))";
        $statement = "TRIM(TRAILING ',' FROM ($statement))";

        $statement = "TRIM(LEADING '-' FROM ($statement))";
        $statement = "TRIM(LEADING 'enye ' FROM ($statement))";
        $statement = "TRIM(LEADING 'wa ' FROM ($statement))";
        $statement = "TRIM(LEADING 'kwa ' FROM ($statement))";
        $statement = "TRIM(LEADING 'a ' FROM ($statement))";

        return $statement;
    }

    /**
     * Exact Search: Retrieves a list of all results which match the search query exactly (no LIKE search)
     * Retrieve lists of models based on the search/filter conditions and different calculations
     */
    public function exactSearch($query='') {
        $query = trim($query,' ,.?!-_"');
        $criteria = new CDbCriteria;

        $criteria->with = array(// vorhandene Relationen in die Query einbeziehen (JOIN) als 'eager loading'
            'wortart_rel',
            'kategorie_rel',
        );
        //$criteria->select='kiswahili';  // the columns being selected
        $criteria->order = "TRIM(LEADING 'a ' FROM (TRIM(LEADING '-' FROM kiswahili))), wortart_id";

        $trim_kiswahili = $this->trimSQL('kiswahili');

        $condition = "($trim_kiswahili=:query OR lower(deutsch)=lower(:query) OR lower(noun_plural_swahili)=lower(:query) OR lower(noun_plural_deutsch)=lower(:query) OR verb_stem=:query OR verb_infinitive=:query)";

        $criteria->condition = $condition;
        $criteria->params=array(':query'=>$query);

        $countAll = $this->count();
        $count = $this->count($criteria);

        $pages = new CPagination($this->count($criteria));
        $pages->pageSize = WortschatzController::PAGE_SIZE;
        $pages->applyLimit($criteria);

        $sort = new CSort('wortschatz');
        $sort->applyOrder($criteria);

        $models = $this->findAll($criteria);

        return array(
            'models' => $models,
            'countAll' => $countAll,
            'count' => $count,
            'pages' => $pages,
            'sort' => $sort,
        );
    }

    /**
     * Word Search: Retrieves a list of all results which contain the search string as a word (Regular Expression with word borders)
     * Retrieve lists of models based on the search/filter conditions and different calculations
     */
    public function wordSearch($query='%') {
        $query = trim($query,' ,.?!-_');
        $condition = "( lower(kiswahili) REGEXP lower(:query) OR lower(deutsch) REGEXP lower(:query) OR lower(noun_plural_swahili) REGEXP lower(:query) OR lower(noun_plural_deutsch) REGEXP lower(:query) OR lower(verb_stem) REGEXP lower(:query) OR lower(verb_infinitive) REGEXP lower(:query) )";
//        $condition="( MATCH (kiswahili) AGAINST ('$query') )";

        $criteria = new CDbCriteria;

        $criteria->with = array(// vorhandene Relationen in die Query einbeziehen (JOIN) als 'eager loading'
            'wortart_rel',
            'kategorie_rel',
        );

        $criteria->order = "TRIM(LEADING 'a ' FROM (TRIM(LEADING '-' FROM kiswahili))), wortart_id";

        $criteria->condition = $condition;
        $criteria->params=array(':query'=>'[[:<:]]'.$query.'[[:>:]]'); //RegEx fuer Wortgrenzen in MySQL

        $countAll = $this->count();
        $count = $this->count($criteria);

        $pages = new CPagination($this->count($criteria));
        $pages->pageSize = WortschatzController::PAGE_SIZE;
        $pages->applyLimit($criteria);

        $sort = new CSort('wortschatz');
        $sort->applyOrder($criteria);

        $models = $this->findAll($criteria);

        return array(
            'models' => $models,
            'countAll' => $countAll,
            'count' => $count,
            'pages' => $pages,
            'sort' => $sort,
        );
    }

    public function standardSearch($query='%') {
        $query = trim($query);
        $condition = "( kiswahili like :query OR lower(deutsch) like lower(:query) OR noun_plural_swahili like :query OR lower(noun_plural_deutsch) like lower(:query) OR lower(verb_stem) like lower(:query) OR lower(verb_infinitive) like lower(:query) )";
//        $condition="( MATCH (kiswahili) AGAINST ('$query') )";

        $criteria = new CDbCriteria;

        $criteria->with = array(// vorhandene Relationen in die Query einbeziehen (JOIN) als 'eager loading'
            'wortart_rel',
            'kategorie_rel',
        );

        $criteria->order = "TRIM(LEADING 'a ' FROM (TRIM(LEADING '-' FROM kiswahili))), wortart_id";

        $criteria->condition = $condition;
        $criteria->params=array(':query'=>'%'.$query.'%');

        $countAll = $this->count();
        $count = $this->count($criteria);

        $pages = new CPagination($this->count($criteria));
        $pages->pageSize = WortschatzController::PAGE_SIZE;
        $pages->applyLimit($criteria);

        $sort = new CSort('wortschatz');
        $sort->applyOrder($criteria);

        $models = $this->findAll($criteria);

        return array(
            'models' => $models,
            'countAll' => $countAll,
            'count' => $count,
            'pages' => $pages,
            'sort' => $sort,
        );
    }

    public function removeExactResults($models_standard, $models_exact) {
        // hier einen Vergleich der Ergebnis-Arrays machen und die Eintraege der exactSearch aus der standardSearch löschen
        //$models_diff = array_diff($models_all,$models_part);

        foreach ($models_exact as $n => $model_exact):
            foreach ($models_standard as $n => $model_standard):
                if ($model_exact->id == $model_standard->id) {
                    unset($models_standard[$n]);
                }
            endforeach;
        endforeach;

        // mit array_merge wird der index des arrays neu erstellt (die keys), das heisst die Datensaetze
        // werden neu von 0 bis x nummeriert. Das ist notwendig damit in der View ungerade und gerade Zeilen fuer 
        // das css unterschieden werden koennen
        $models_standard = array_merge($models_standard);

        return array(
            'models' => $models_standard,
        );
    }

    public function makeSearchLink($text) {
        $textArray = explode(' ', $text);
        foreach ($textArray as &$word) {
            if ($word != '') {
                $word = '<a href="' . Yii::app()->baseUrl . '/index.php/wortschatz/search?SearchForm[searchq]=' . trim($word, ", . ( ) ! ? - : _ { } [ ]") . '">' . $word . '</a>';
            }
        }
        $text = implode(' ', $textArray);

        return $text;
    }

    public function findSimilar($query='') {
        $criteria_1 = new CDbCriteria;

        $criteria_1->select = 'kiswahili';
        $criteria_1->condition = "( soundex(TRIM(LEADING '-' FROM kiswahili)) = soundex('$query') AND TRIM(LEADING '-' FROM kiswahili) != '$query' )";
        $criteria_1->group = 'kiswahili';


        $models_kiswahili = $this->findAll($criteria_1);

        return array(
            'models_kiswahili' => $models_kiswahili,
        );
    }

}