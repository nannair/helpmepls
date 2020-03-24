<!DOCTYPE HTML>
<?php
require 'login.php';
require __DIR__ . '/vendor/autoload.php';
use Google\Cloud\Datastore\DatastoreClient;
use Google\Cloud\Datastore\Entity;
use Google\Cloud\Datastore\EntityIterator;
use Google\Cloud\Datastore\Key;
use Google\Cloud\Datastore\Query\Query;
$query = $datastore->query()
->kind('User')
->projection(['password'])
->filter('__key__', '>', $datastore->key('user', $user));
$password = $datastore->runQuery($query);

$newpassword = $POST('newpassword');
if($POST('password') == $password){

    $transaction = $datastore->transaction();
    $key = $datastore->key('user', $user);
    $password = $transaction->lookup($key);
    $password['password'] = $newpassword;
    $transaction->update($password);
    $transaction->commit();
    header("Location: /login");
    
}
else {echo('old password incorrect'); }

?>

<html>
    <body>
        <form method = "post" action = "password.php">
            Name: <br/>
            <input type = "password" name = "password"><br/>
            New Name: <br/>
            <input type = "password" name = "newpassword"><br/>
            <input type = "submit" value = "change">
        </form>
    </body>
</html>