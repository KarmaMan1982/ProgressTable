<?php
    class ZyklusEditor{
        private $columns;
        private $headerElements;
        private $bodyElements;
        private $header;
        private $body;
        private $footer;
        private $name;
        private function createHeaderElementWithClass($class,$name){
            $this->headerElements[] = '<th class="'.$class.'">'.$name.'</th>';
        }
        private function createHeaderElement($name){
            $this->headerElements[] = '<th>'.$name.'</th>';
        }
        private function createHeader(){
            $this->header = '<thead><tr>';
            foreach ($this->headerElements AS $Element){
                $this->header .= $Element;
            }
            $this->header .= '</tr></thead>';
        }
        private function createBodyElement($zeilenNummer,$position,$name,$value){
            if($name == 'ZyklusName'){
                $inputElement = '<input type="text" name="ZyklusField['.$zeilenNummer.']['.$name.']" value="'.$value.'" >';
            } else {
                $position--;
                $inputElement = '<input type="hidden" name="ZyklusField['.$zeilenNummer.'][ProgressField]['.$position.'][ProgressName]" value="'.$name.'" >';
                $inputElement .= '<input type="text" name="ZyklusField['.$zeilenNummer.'][ProgressField]['.$position.'][ProgressTime]" value="'.$value.'" >';
            }

            return '<td>'.$inputElement.'</td>';
        }
        private function createBodyRow($zeilenNummer,$zeile){
            $rowPosition = 0;
            $row = '<tr>';
            foreach ($this->columns As $Column){
                if(isset($zeile[$rowPosition])){
                    if(isset($zeile[$rowPosition]['ZyklusName'])){ $row .= $this->createBodyElement($zeilenNummer,$rowPosition,'ZyklusName', $zeile[$rowPosition]['ZyklusName']); }
                    if(isset($zeile[$rowPosition]['ProgressName'])){ $row .= $this->createBodyElement($zeilenNummer,$rowPosition,$zeile[$rowPosition]['ProgressName'], $zeile[$rowPosition]['ProgressTime']); }
                } else {
                    $row .= $this->createBodyElement($zeilenNummer,$rowPosition,$Column, 0);
                }
            $rowPosition++;    
            }
            $row .= '</tr>';
            $this->bodyElements[] = $row; 
        }
        private function createFooter(){
            $colspan = sizeof($this->columns) - 1;
            $this->footer = '<tfoot><tr>';
            $this->footer .= '<td><label for="CollectionName">Modell-Typ</label><input type="text" name="CollectionName" id="CollectionName" value="'.$this->name.'"></td>';
            $this->footer .= '<td colspan="'.$colspan.'"><input type="submit" value="Zyklen speichern"></td>';
            $this->footer .= '</tr></tfoot>';
        }
        private function createBody(){
            $this->body = '<tbody>';
            foreach ($this->bodyElements AS $Element){
                $this->body .= $Element;
            }
            $this->body .= '</tbody>';
        }
        private function getPositionFromColumn($searchElement){
            $Position = 0;
            $searchPosition = null;
            foreach ($this->columns AS $Column){
                if($Column == $searchElement){
                    $searchPosition = $Position;
                }
                $Position++;
            }
            return $searchPosition;
        }
        public function __construct($columns) {
            $this->columns = $columns;
            foreach ($this->columns AS $Column){
                if($Column == 'Name'){ $this->createHeaderElementWithClass('ZyklusName', $Column); }
                else { $this->createHeaderElement($Column); }
            }
            $this->createHeader();
        }
        public function loadJSON($jsonFile){
            if(file_exists($jsonFile)){
                $inputObject = json_decode(file_get_contents($jsonFile));
                $this->name = $inputObject->CollectionName;
                #var_dump($inputObject->ZyklusField);
                $zeilenNummer = 0;
                foreach($inputObject->ZyklusField AS $ZyklusElement){
                    #$inputZyklus = new ZyklusController($ZyklusElement->ZyklusName);
                    $zeile = array();
                    $zeile[0] = array(
                        'ZyklusName' => $ZyklusElement->ZyklusName
                    );
                    #$zeile[0] = $ZyklusElement->ZyklusName;
                    foreach ($ZyklusElement->ProgressField AS $Progress){
                        #var_dump($Progress);
                        $searchPosition = $this->getPositionFromColumn($Progress->ProgressName);
                        if($searchPosition != null){$zeile[$searchPosition]=array(
                            'ProgressName' => $Progress->ProgressName,
                            'ProgressTime' => $Progress->ProgressTime
                        );}
                        #$inputZyklus->addProgress($Progress->ProgressName, $Progress->ProgressTime);
                    }
                    #var_dump($zeile);
                    $this->createBodyRow($zeilenNummer,$zeile);
                    $this->createBody();
                    #var_dump($ZyklusElement);
                    $zeilenNummer++;
                }
                $this->createFooter();
            }            
        }
        public function outputTable(){
            echo '<form id="ZyklusEditForm" method="POST" action="'.$_SERVER['PHP_SELF'].'">';
            echo '<table id="ZyklusEditTable">';
            echo $this->header;
            echo $this->body;
            echo $this->footer;
            echo '</table>';
            echo '</form>';
        }
        
    }
?>