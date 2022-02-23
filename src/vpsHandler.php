<?php

/**
 * File with the extension Prototype Methods.
 *
 * Creator of the extension: t.me/gian0012
 * Licensed under the terms of the MIT License.
 */

use \skrtdev\NovaGram\Bot;

$output ??= NULL;

Bot::addMethod("whoami", function () {

    $output = system("whoami");
    return $output;
});

Bot::addMethod("reboot", function () { // WARNING: This method will reboot your VPS.

    $output = system("sudo reboot");
});

Bot::addMethod("getIP", function () {

    $l = system("curl ipinfo.io/ip");
    return ($l);
});

Bot::addMethod("serviceRestart", function ($serviceName) { // try this commands using: $Bot->serviceRestart("mysql");
    $escapedServiceName = escapeshellarg($serviceName);
    exec("systemctl restart $escapedServiceName" );
});

Bot::addMethod("uptime", function () {

    $output = exec("uptime");
    return " $output UTC";
});

Bot::addMethod("ramUse", function () {

    exec("free -h",$output);
    $t0 = preg_replace('#[\s]+#', ' | ', $output[0]);
    $t1 = preg_replace('#[\s]+#', ' | ', $output[1]);
    $t2 = preg_replace('#[\s]+#', ' | ', $output[2]);
    return "$t0\n$t1\n$t2";
});

Bot::addMethod("startBot", function ($sessionName,$DirToFile) { //try this commands using: $Bot->startBot("screensession","/botdir/main.php");
    // This command just might to work only with NovaGram or cli-based php libraries.
    $escapedSessionName = escapeshellarg($sessionName);
    $escapedDirToFile = escapeshellarg($DirToFile);
    exec("screen -d -S $escapedSessionName -m php $escapedDirToFile");

});

Bot::addMethod("killBot", function ($sessionName) { //try this commands using: $Bot->killBot("screensession");
    // This command just might to work only with NovaGram or cli-based php libraries.
    $escapedSessionName = escapeshellarg($sessionName);
    exec("screen -X -S $escapedSessionName kill");

});




?>