<?php
include('Net/SSH2.php');
include('openstackInfo.php');

$ssh = new Net_SSH2($ipAddress . ':'. $port);
if (!$ssh->login($user, $pass)) {
    exit('Login Failed');
}

//get service name
$instance =  $_POST['vmName'];


echo $ssh->exec('source keystonerc_admin');

echo $ssh->exec('nova start ' .$instance);

sleep(5);

header('"Location":"../ui/vmInstances.php"');

?>