<?php
// @version $Id$
class Timer extends CApplicationComponent {

        public $startTime;

        public function init()
        {
                $time = microtime(true);
//                Yii::trace('start timer @ '.$time,'components.Timer.init()');
                $this->startTime = $time;
        }

        public function getTimer()
        {
                $time = microtime(true);
//                Yii::trace('stop timer @ '.$time,'components.Timer.getTimer()');
                $endtime = $time;

                return ($endtime - $this->startTime);
        }
}
