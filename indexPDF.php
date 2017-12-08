<?php
    require_once('./scripts/getZyklus.php');
    require_once('./scripts/getZyklusCollection.php');
    require_once('lib/classZyklusEditor.php');
    require('./lib/html_table.php');
    $testFile = 'output.json';
    $ZyklusCollection->inputJSON($testFile);
    $TableElementsOld = array(
        'Name',
        'Verdichter 1',
        'Verdichter 2 / Tauchpumpe',
        'UV-Ausgang',
        'Kühlfilter 1',
        'Kühlfilter 2',
        'Ausgang frei wählbar',
        'Ventil 1',
        'Ventil 2',
        'Ventil 3',
        'Ventil 4',
        'Dosierpumpe 1',
        'Dosierpumpe 2',
        'Dosierpumpe 3',
        'Warnlampe',
        'Kühlfilter',
        'Ausgang frei Wählbar bis 6W'
    );
    $TableElements1 = array(
        'Name',
        'Verdichter 1',
        'Verdichter 2 / Tauchpumpe',
        'UV-Ausgang',

    );    
    $TableElements2 = array(
        'Name',
        'Kühlfilter 1',
        'Kühlfilter 2',
        'Ausgang frei wählbar'
    );        
    $TableElements3 = array(
        'Name',
        'Ventil 1',
        'Ventil 2',
        'Ventil 3',
        'Ventil 4'
    );            
    $TableElements4 = array(
        'Name',
        'Dosierpumpe 1',
        'Dosierpumpe 2',
        'Dosierpumpe 3'

    );  
    $TableElements5 = array(
        'Name',    
        'Warnlampe',
        'Kühlfilter',
        'Ausgang frei Wählbar bis 6W'
    );
    $ZyklusTable1 = new ZyklusEditor($TableElements1);
    $ZyklusTable1->loadJSON($testFile);
    $PrintTable = $ZyklusTable1->returnTable();
    $ZyklusTable2 = new ZyklusEditor($TableElements2);
    $ZyklusTable2->loadJSON($testFile);
    $PrintTable .= $ZyklusTable2->returnTable();
    $ZyklusTable3 = new ZyklusEditor($TableElements3);
    $ZyklusTable3->loadJSON($testFile);
    $PrintTable .= $ZyklusTable3->returnTable();
    $ZyklusTable4 = new ZyklusEditor($TableElements4);
    $ZyklusTable4->loadJSON($testFile);
    $PrintTable .= $ZyklusTable4->returnTable();
    $ZyklusTable5 = new ZyklusEditor($TableElements5);
    $ZyklusTable5->loadJSON($testFile);
    $PrintTable .= $ZyklusTable5->returnTable();     
    $pdf=new PDF('L','mm','A4');
    $pdf->AddPage();
    $pdf->SetFont('Arial','',12);

    $html='<table border="1">
    <tr>
    <td width="200" height="30">cell 1</td><td width="200" height="30" bgcolor="#D0D0FF">cell 2</td>
    </tr>
    <tr>
    <td width="200" height="30">cell 3</td><td width="200" height="30">cell 4</td>
    </tr>
    </table>';
    #echo $PrintTable;
    #$pdf->WriteHTML($html);
    $pdf->WriteHTML($PrintTable);
    $pdf->Output();    
?>