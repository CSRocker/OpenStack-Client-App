<?php
include('Net/SSH2.php');

$user = 'root';
$pass ='cmpe283';

$ssh = new Net_SSH2('10.189.253.53');
if (!$ssh->login($user, $pass)) {
    exit('Login Failed');
}

echo $ssh->exec('source keystonerc_admin');

echo $ssh->exec('nova flavor-list');
?>