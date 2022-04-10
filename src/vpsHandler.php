<?php


namespace gian0012\VPSHandler;


/**
 *
 *
 * Creator of the extension: gian0012.tk
 * Licensed under the terms of the MIT License.
 *
 *
 */


Class vps {



    public function whoami() {

        $response = system("whoami");
        return $response;
    }


    public function reboot() : void {

        system("sudo reboot");

    }


    public function getIP() {

        $response = system("curl ipinfo.io/ip");
        return $response;

    }

    public function serviceRestart($serviceName) : void {  // try this command using: i.e. $vps->serviceRestart("mysql");

        $escapedServiceName = escapeshellarg($serviceName);
        exec("systemctl restart $escapedServiceName" );

    }


    public function uptime() {

        $response = exec("uptime");
        return $response . " UTC";
    }


    public function ramUse() {

        exec("free -h",$output);
        $t0 = preg_replace('#[\s]+#', ' | ', $output[0]);
        $t1 = preg_replace('#[\s]+#', ' | ', $output[1]);
        $t2 = preg_replace('#[\s]+#', ' | ', $output[2]);
        return "$t0\n$t1\n$t2";

    }

    public function startBot($sessionName,$DirToFile) : void { // try this command using: i.e. $vps->startBot("session","/dir/to/file.php");

        // This command just might to work only with NovaGram or cli-based php libraries.
        $escapedSessionName = escapeshellarg($sessionName);
        $escapedDirToFile = escapeshellarg($DirToFile);
        exec("screen -d -S $escapedSessionName -m php $escapedDirToFile");

    }

    public function killBot($sessionName) : void { // try this command using: i.e. $vps->killBot("sesssion");

        // This command just might to work only with NovaGram or cli-based php libraries.
        $escapedSessionName = escapeshellarg($sessionName);
        exec("screen -X -S $escapedSessionName kill");

    }

    public function sessionList() {

        exec("sudo screen -ls",$output);
        return $output[0];

    }





}

?>