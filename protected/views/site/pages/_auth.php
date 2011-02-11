<?php
//this page is necessary for Single Sign On (SSO) with the forum (Vanilla Forum with proxyConnect Addon)
$this->layout=false;
if (Yii::app()->user->isGuest==false) {
$user=User::model()->findByAttributes(array('id'=>Yii::app()->user->id));
echo 'UniqueID=' . Yii::app()->user->id. PHP_EOL;
echo 'Name=' . Yii::app()->user->name . PHP_EOL;
echo 'Email=' . ($user['email']) . PHP_EOL;
}

?>
