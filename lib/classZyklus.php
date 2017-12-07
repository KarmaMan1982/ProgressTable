<?php
class ZyklusController{
    private $name;
    private $progressField;
    private $completeTime;
    private $startDayStamp;
    private $endDayStamp;
    private $dayStamp;
    private $ZyklusPerDay;
    private $activeZyklus;
    
    private function setStartDayStamp(){
        $startDay = new DateTime();
        $startDay->setTime(0, 0, 0);
        $this->startDayStamp = $startDay->getTimestamp();        
    }
    private function setEndDayStamp(){
        $endDay = new DateTime();
        $endDay->setTime(23, 59, 59);
        $this->endDayStamp = $endDay->getTimestamp();        
    }
    private function calcCompleteTime(){
        $this->completeTime = 0;
        foreach ($this->progressField AS $Progress){
            #var_dump($Progress);
            $this->completeTime += $Progress['ProgressTime'];
        }        
    }
    private function calcZyklusPerDay(){
        $this->dayStamp = $this->endDayStamp - $this->startDayStamp;
        $this->ZyklusPerDay = $this->dayStamp / $this->completeTime;
    }
    private function calcActiveZyklus(){
        $endZyklusStamp = $this->startDayStamp;
        $this->activeZyklus = '';
        $this->calcCompleteTime();
        $this->calcZyklusPerDay();
        $Now = new DateTime();
        while ($endZyklusStamp <= $Now->getTimestamp()){
            foreach ($this->progressField AS $Progress){
                if($endZyklusStamp <= $Now->getTimestamp()){
                $this->activeZyklus = $Progress['ProgressName'];
                $endZyklusStamp += $Progress['ProgressTime'];
                }
            } 
        }
    }    
    public function __construct($name) {
        $this->name = $name;
        $this->completeTime = 0;
        $this->setStartDayStamp();
        $this->setEndDayStamp();
    }
    public function addProgress($name,$time){
        $Progress = array(
            'ProgressName' => $name,
            'ProgressTime' => $time / 100
        );
        $this->progressField[] = $Progress;
    }
    public function getCompleteTime(){
        $this->calcCompleteTime();
        return $this->completeTime;
    }
    public function getZyklusPerDay(){
        $this->calcCompleteTime();
        $this->calcZyklusPerDay();
        return $this->ZyklusPerDay;
    }
    public function getActiveZyklus(){
        $this->calcActiveZyklus();
        return $this->activeZyklus;
    }
    public function outputHTML(){
        $this->calcActiveZyklus();
        $Width = 100 / sizeof($this->progressField);
        $widthStyle = 'width: '.$Width.'%;';
        $output = '<table class="progressTable" style="width: 100%;"><tr>';
        $progressNumber = 0;
        foreach ($this->progressField AS $Progress){
            $ProgressID = 'ProgressElement'.$progressNumber;
            if($this->activeZyklus == $Progress['ProgressName']) { $output .= '<td id="'.$ProgressID.'" class="Active" style="'.$widthStyle.'">'.$Progress['ProgressName'].'</td>'; }
            else { $output.='<td id="'.$ProgressID.'" class="Inactive" style="'.$widthStyle.'">'.$Progress['ProgressName'].'</td>'; }
            $progressNumber++;
        }         
        $output .= '</tr></table>';
        return $output;
    }
    public function outputJSON(){
        $this->calcActiveZyklus();
        $returnProgress = array();
        $progressNumber = 0;
        foreach ($this->progressField AS $Progress){
            $ProgressName = $Progress['ProgressName'];
            $ProgressTime = $Progress['ProgressTime'];
            $ProgressID = 'ProgressElement'.$progressNumber;
            $ProgressStatus = '';
            if($this->activeZyklus == $Progress['ProgressName']) { $ProgressStatus = 'Active'; }
            else { $ProgressStatus= 'Inactive'; }
            $pointerProgress = array(
                    'ProgressName' => $ProgressName,
                    'ProgressTime' => $ProgressTime,
                    'ProgressStatus' => $ProgressStatus,
                    'ProgressID' => $ProgressID
            );
            $returnProgress[]=$pointerProgress;
            $progressNumber++;
        }        
        $returnField = array(
            'Name' => $this->name,
            'ProgressField' => $returnProgress
        );
        return json_encode($returnField);
    }
    public function outputARRAY(){
        $returnProgress = array();
        foreach ($this->progressField AS $Progress){
            $ProgressName = $Progress['ProgressName'];
            $ProgressTime = $Progress['ProgressTime'];
            $pointerProgress = array(
                    'ProgressName' => $ProgressName,
                    'ProgressTime' => $ProgressTime
            );
            $returnProgress[]=$pointerProgress;
        }        
        $returnField = array(
            'ZyklusName' => $this->name,
            'ProgressField' => $returnProgress
        );
        return $returnField;
    }
    public function outputNAME(){
        return $this->name;
    }
}
?>