<!DOCTYPE HTML>
<?php
require __DIR__ . '/vendor/autoload.php';
use Google\Cloud\Datastore\DatastoreClient;
use Google\Cloud\Datastore\Entity;
use Google\Cloud\Datastore\EntityIterator;
use Google\Cloud\Datastore\Key;
use Google\Cloud\Datastore\Query\Query;
$newpname = $POST('newname');
if($POST('name') != null){

    $transaction = $datastore->transaction();
    $key = $datastore->key('user', $user);
    $name = $transaction->lookup($key);
    $name['name'] = $newname;
    $transaction->update($name);
    $transaction->commit();

    header("Location: main.php");
}
else {echo('username cannot be empty'); }

?>

<html>
    <body>
        <form method = "post" action = "name.php">
            User Nam: <br/>
            <input type = "text" name = "name"><br/>
            New User Name: <br/>
            <input type = "text" name = "newname"><br/>
            <input type = "submit" value = "change">
        </form>
    </body>
</html>