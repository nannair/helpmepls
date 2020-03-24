<!DOCTYPE HTML>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
//session_start();
require_once 'main.php';
require __DIR__ . '/vendor/autoload.php';
use Google\Cloud\Datastore\DatastoreClient;
/*use Google\Cloud\Datastore\Entity;
use Google\Cloud\Datastore\EntityIterator;
use Google\Cloud\Datastore\Key;
use Google\Cloud\Datastore\Query\Query;*/
$projectId = 's3784955-cc2018';

$datastore = new DatastoreClient([
    'projectId' => $projectId]);


//s$id = $POST['id'];
$key = $datastore->key('user', $POST['id']);
$user = $datastore->lookup($key);



/*$query = $datastore->query()
                ->kind('User')
                ->filter('__key__', '>', $datastore->key('user', 's3784955'))
                ->filter('__key__', '>', $datastore->key('user', 's37849551'))
                ->filter('__key__', '>', $datastore->key('user', 's37849552'));

$user = $datastore->runQuery($query);*/


if (isset($SESSION['logged_in']) && $SESSION['logged_in'] == true) {
    header("Location: /main") ;
} 
    

if (isset($POST['id']) && isset($POST['password'])){
    if ( $POST['id'] && $POST['password'] == $user)
    {
        $SESSION['logged_in'] = true;
        header("Location: /main");
    } else {
        echo("Invalid username or password");
    }
}

?>

<html>
    <body>
        <form method = "post" action = "login.php">
            Username: <br/>
            <input type = "text" name = "id"><br/>
            Password: <br/>
            <input type = "password" name = "password"><br/>
            <input type = "submit" value = "login">
        </form>
    </body>
</html>