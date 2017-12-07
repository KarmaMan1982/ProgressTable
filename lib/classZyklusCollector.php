<?php
    require_once('classZyklus.php');
    
    class ZyklusCollector{
        private $name;
        private $collection;
        public function __construct($name) {
            $this->name = $name;
        }
        public function addZyklus($inputZyklus){
            $this->collection[] = $inputZyklus;
        }
        public function inputJSON($jsonFile){
            if(file_exists($jsonFile)){
                $inputObject = json_decode(file_get_contents($jsonFile));
                $this->name = $inputObject->CollectionName;
                #var_dump($inputObject->ZyklusField);
                foreach($inputObject->ZyklusField AS $ZyklusElement){
                    $inputZyklus = new ZyklusController($ZyklusElement->ZyklusName);
                    foreach ($ZyklusElement->ProgressField AS $Progress){
                        #var_dump($Progress);
                        $inputZyklus->addProgress($Progress->ProgressName, $Progress->ProgressTime);
                    }
                    $this->collection[] = $inputZyklus;
                    #var_dump($ZyklusElement);
                }
            }
        }
        public function printNames(){
            foreach ($this->collection AS $Zyklus){
                echo $Zyklus->outputNAME();
            }
        }
        public function outputARRAY(){
            $returnZyklus = array();
            foreach ($this->collection AS $Zyklus){
                $returnZyklus[]=$Zyklus->outputARRAY();
            }        
            $returnField = array(
                'CollectionName' => $this->name,
                'ZyklusField' => $returnZyklus
            );
            return $returnField;
        }
        public function outputJSON(){
            $returnZyklus = array();
            foreach ($this->collection AS $Zyklus){
                $returnZyklus[]=$Zyklus->outputARRAY();
            }        
            $returnField = array(
                'CollectionName' => $this->name,
                'ZyklusField' => $returnZyklus
            );
            return json_encode($returnField);
        }        
    }
?>