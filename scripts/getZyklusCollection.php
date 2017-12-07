<?php
                $classFile = './lib/classZyklusCollector.php';

                if(!file_exists($classFile)){ $classFile = '.'.$classFile; }
                require_once($classFile);
                $ZyklusCollection = new ZyklusCollector('basic');
                $ZyklusObject0 = new ZyklusController('SZ 35');
                $ZyklusObject0->addProgress('Verdichter 1', 550);
                $ZyklusObject0->addProgress('Verdichter 2 / Tauchpumpe', 550);
                $ZyklusObject0->addProgress('Kühlfilter 1', 375);                
                $ZyklusObject0->addProgress('Kühlfilter 2', 375);
                $ZyklusObject0->addProgress('Ventil 1', 36);
                $ZyklusObject0->addProgress('Ventil 2', 36);
                $ZyklusObject0->addProgress('Ventil 3', 36);
                $ZyklusObject0->addProgress('Ventil 4', 36);
                $ZyklusObject0->addProgress('Dosierpumpe 2', 16);
                $ZyklusObject0->addProgress('Dosierpumpe 3', 16);
                $ZyklusObject0->addProgress('Kühlfilter', 10.1);
                $ZyklusObject0->addProgress('Ausgang frei Wählbar', 6);
                #$ZyklusCollection->addZyklus($ZyklusObject0);
                $ZyklusObject1 = new ZyklusController('SZ 36');
                $ZyklusObject1->addProgress('Verdichter 1', 550);
                $ZyklusObject1->addProgress('Verdichter 2 / Tauchpumpe', 550);
                $ZyklusObject1->addProgress('Kühlfilter 1', 375);                
                $ZyklusObject1->addProgress('Kühlfilter 2', 375);
                $ZyklusObject1->addProgress('Ventil 1', 36);
                $ZyklusObject1->addProgress('Ventil 2', 36);
                $ZyklusObject1->addProgress('Ventil 3', 36);
                $ZyklusObject1->addProgress('Ventil 4', 36);
                $ZyklusObject1->addProgress('Dosierpumpe 2', 16);
                $ZyklusObject1->addProgress('Dosierpumpe 3', 16);
                $ZyklusObject1->addProgress('Kühlfilter', 10.1);
                $ZyklusObject1->addProgress('Ausgang frei Wählbar', 6);                
                #$ZyklusCollection->addZyklus($ZyklusObject1);
                
?>