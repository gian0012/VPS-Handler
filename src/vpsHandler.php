<?php

use \skrtdev\NovaGram\Bot;
use \skrtdev\Telegram\Message;

$output ??= NULL;

Bot::addMethod("whoami", function () {

    exec("whoami",$output);
    return $output[0];
});

Bot::addMethod("reboot", function () {

    exec("reboot",$output);
});

Bot::addMethod("getIP", function () {

    exec("curl ipinfo.io/ip",$output);
    return ($output[0]);
});

Bot::addMethod("systemRestart", function ($text) {

    exec("systemctl restart $text ",$output);
});

Bot::addMethod("uptime", function () {

    exec("uptime",$output);
    $params = explode(" ",$output[0])[1];
    return " $params UTC";
});

Bot::addMethod("ramUse", function () {

    exec("free -h",$output);
    $t0 = preg_replace('#[\s]+#', ' | ', $output[0]);
    $t1 = preg_replace('#[\s]+#', ' | ', $output[1]);
    $t2 = preg_replace('#[\s]+#', ' | ', $output[2]);
    return "$t0\n$t1\n$t2";
});

Bot::addMethod("startBot", function ($sessionName,$DirToFile) {

    exec("screen -d -S $sessionName -m $DirToFile ");
    

});


?>
