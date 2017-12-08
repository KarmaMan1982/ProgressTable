<html>
    <head>
        <title>Progress-Table</title>
        <?php
        $oldFirefox = false;
        $browser = get_browser(null, true);
        if($browser['browser'] == 'Firefox' && $browser['majorver'] <= 10){ $oldFirefox = true; }        
        ?>
        <?php if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 6.') !== false || $oldFirefox == true) { ?>
        <!--
        <link href="style/reset.css" rel="stylesheet" type="text/css"/>
        -->
        <link href="lib/jquery-ui-1.9.2.custom/css/excite-bike/jquery-ui-1.9.2.custom.css" rel="stylesheet" type="text/css"/>
        <link href="style/oldIE.css" rel="stylesheet" type="text/css"/> 
        <?php } else { ?>
        <link href="lib/jquery-ui-themes-1.12.1/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <link href="lib/jquery-ui-themes-1.12.1/jquery-ui.theme.css" rel="stylesheet" type="text/css"/>
        <link href="lib/jquery-ui-themes-1.12.1/themes/excite-bike/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <link href="lib/jquery-ui-themes-1.12.1/themes/excite-bike/theme.css" rel="stylesheet" type="text/css"/>
        <?php } ?> 
        <link href="style/ProgressTable.css" rel="stylesheet" type="text/css"/>        
        <?php if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 6.') !== false || $oldFirefox == true) { ?>
        <script src="lib/jquery-ui-1.9.2.custom/js/jquery-1.8.3.js" type="text/javascript"></script> 
        <script src="lib/jquery-ui-1.9.2.custom/js/jquery-ui-1.9.2.custom.js" type="text/javascript"></script>
        <script src="js/indexIE6.js" type="text/javascript"></script>          
        <?php } else { ?>        
        <script src="lib/jquery-ui-1.12.1/external/jquery/jquery.js" type="text/javascript"></script>
        <script src="lib/jquery-ui-1.12.1/jquery-ui.js" type="text/javascript"></script>
        <?php } ?>
        <script src="js/index.js" type="text/javascript"></script>        
    </head>
    <body>
            <?php
                require_once('./scripts/getZyklus.php');
                echo $ZyklusObject->outputHTML();
                require_once('./scripts/getZyklusCollection.php');
                #$ZyklusCollection->printNames();
            ?>
        <div id="ActiveProgressName">&nbsp;</div>
            <?php
                $testFile = 'output.json';
                if(isset($_REQUEST)){
                    #var_dump($_REQUEST);
                    if(isset($_REQUEST['CollectionName']) && isset($_REQUEST['ZyklusField'])){
                        file_put_contents($testFile, json_encode($_REQUEST));
                    }
                }                
                #file_put_contents($testFile, $ZyklusCollection->outputJSON());
                #echo $ZyklusCollection->outputJSON();
                #$CollectionObject = json_decode(file_get_contents($testFile));
                #var_dump($CollectionObject);
                $ZyklusCollection->inputJSON($testFile);
                $ZyklusCollection->printNames();
                require_once('lib/classZyklusEditor.php');
                
                $TableElements = array(
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
                $ZyklusTable = new ZyklusEditor($TableElements);
                $ZyklusTable->loadJSON($testFile);
                $ZyklusTable->outputTable();

            ?>
        <br>
        <a href="indexPDF.php">PDF erstellen</a>
        
    </body>
</html>