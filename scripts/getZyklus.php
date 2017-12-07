<?php
                $classFile = './lib/classZyklus.php';

                if(!file_exists($classFile)){ $classFile = '.'.$classFile; }
                require_once($classFile);
                $ZyklusObject = new ZyklusController('SZ 35');
                $ZyklusObject->addProgress('Verdichter 1', 550);
                $ZyklusObject->addProgress('Verdichter 2 / Tauchpumpe', 550);
                $ZyklusObject->addProgress('Kühlfilter 1', 375);                
                $ZyklusObject->addProgress('Kühlfilter 2', 375);
                $ZyklusObject->addProgress('Ventil 1', 36);
                $ZyklusObject->addProgress('Ventil 2', 36);
                $ZyklusObject->addProgress('Ventil 3', 36);
                $ZyklusObject->addProgress('Ventil 4', 36);
                $ZyklusObject->addProgress('Dosierpumpe 2', 16);
                $ZyklusObject->addProgress('Dosierpumpe 3', 16);
                $ZyklusObject->addProgress('Kühlfilter', 10.1);
                $ZyklusObject->addProgress('Ausgang frei Wählbar', 6);
                #echo $ZyklusObject->outputHTML();
                #echo $ZyklusObject->outputJSON();
                if (isset($_REQUEST['output'])){
                    echo $ZyklusObject->{$_REQUEST['output']}();
                }                
?>