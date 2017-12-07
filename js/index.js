    setInterval(function(){
        $.post('./scripts/getZyklus.php',{
            output: 'outputJSON',
            data: null
        }, function(data){
            //console.log(data);
            for (e in data.ProgressField){
                var ProgressID = data.ProgressField[e].ProgressID;
                var ProgressName = data.ProgressField[e].ProgressName;
                var ProgressTime = data.ProgressField[e].ProgressTime;
                var ProgressStaus = data.ProgressField[e].ProgressStatus;
                //$('#'+ProgressID).removeAttr('class');
                $('#'+ProgressID).attr('class',ProgressStaus);
                //console.log(ProgressStaus);
                if(ProgressStaus == 'Active'){
                    //console.log(ProgressName);
                    $('#ActiveProgressName').html(ProgressName);
                }
                //console.log(data.ProgressField[e].ProgressID);
            }
       },'json');
    },1000);