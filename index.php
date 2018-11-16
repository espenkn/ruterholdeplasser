<?php


$holdeplasser = [
    3010533 => 'Sofienberg (i Trondheimsvn)',
    3011400 => 'Carl Berners plass [T-bane]',
    3010537 => 'Sars gate (Oslo)',
    3011402 => 'Carl Berners plass (Chr.Mich.g.)',
    3011417 => 'Carl Berners plass T [buss]',
];


$monurl = 'https://mon.ruter.no/monitor/3010533/Sofienberg%20(i%20Trondheimsvn)%20(Oslo)/3011400/Carl%20Berners%20plass%20[T-bane]%20(Oslo)/';

?>

<DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Ruter Monitor</title>

<style>


header {
    width: 100%;
    background-color: black;
    color: white;
    font-family: arial;
}

header > form {
    margin: 0px;
    padding: 0px;
}

#monitor {
    width: 100%;
}
iframe {
    width: 100%;
    border: 0px;
    margin: 0px;
    padding: 0px;
    overflow: hidden;
    height: 100%;
}

</style>
</head>
<body>
<header>
<p>Velg opptil 2 holdeplasser</p>
<form>
<?php

$holdeplasser_javascript_map = "[\n";

foreach ($holdeplasser as $key => $value) {

    $holdeplasser_javascript_map .= "[ '$key', '$value' ],\n";

    echo '
    <label>
        <input type="checkbox" name="holdeplass[]" value="',$key,'" />
        ',$value,'
    </label> ';
}
$holdeplasser_javascript_map = substr($holdeplasser_javascript_map, 0, -2);
$holdeplasser_javascript_map .= "\n]";



?>
</form>
</header>
<section id="monitor">
<iframe id="ruterMonitor" src="<?= $monurl ?>" ></iframe>
</section>


<script type="text/javascript">
/*
window.sessionStorage.setItem('key', 'val');
window.sessionStorage.getItem('key');
window.sessionStorage.clear();
window.sessionStorage.length;
window.sessionStorage.removeItem('key');
*/

var ruterApp = function() {

    let monurl = 'https://mon.ruter.no/monitor/';

    let holdeplaser = new Map(<?= $holdeplasser_javascript_map ?>);

    let default_holdeplasser = ['3010533', '3011400'];


    let app = {
        
        init : function() {
            app.scanChecboxesOnLoad();
            app.regEventHandlers();
        },

        scanChecboxesOnLoad : function() {

            let selectedHoldeplasser = window.sessionStorage.getItem('holdeplasser');

            if (selectedHoldeplasser == null) {
                selectedHoldeplasser = default_holdeplasser;
            } else {
                selectedHoldeplasser = selectedHoldeplasser.split(',');
            }
        
            let boxes = document.getElementsByTagName('input');
            for(box of boxes) {

                if (selectedHoldeplasser.includes(box.value)) {
                    box.checked = true;
                } else {
                    box.checked = false;
                }
            }

            //Save state
            window.sessionStorage.setItem('holdeplasser', selectedHoldeplasser);
        },


        checkboxChange : function(event) {
            //selected, and if selecting 3 checkboxes clear oldest (rotate/unshift array)

            let selectedHoldeplasser = window.sessionStorage.getItem('holdeplasser').split(',');

            let value = event.target.value;
            let checked = event.target.checked;

            if (checked) {
                //Can not have more than 2 
                if (selectedHoldeplasser.length > 1) {
                    let uncheckThis = selectedHoldeplasser.shift();
                }
                
                selectedHoldeplasser.push(value);

                let checks = document.getElementsByTagName('input');

                for(check of checks) {
                    if (selectedHoldeplasser.includes(check.value)) {
                        check.checked = true;
                    } else {
                        check.checked = false;   
                    }

                }

            } else {
                selectedHoldeplasser = selectedHoldeplasser.filter(item => item !== value);
                
            }

            window.sessionStorage.setItem('holdeplasser', selectedHoldeplasser);

            //Set new url
            let appframe = document.getElementById('ruterMonitor');

            let appstr = '';
            for(h in selectedHoldeplasser) {
                appstr += selectedHoldeplasser[h] + '/' + holdeplaser.get(selectedHoldeplasser[h]) + '/';
            }

            appframe.src = monurl + appstr;
        },

        regEventHandlers : function() {
            let boxes = document.getElementsByTagName('input');
            for(box of boxes) {
                box.addEventListener('change', this.checkboxChange);
            }
        }

    }

    return app;

}();
   


window.addEventListener('load', ruterApp.init);




</script>
