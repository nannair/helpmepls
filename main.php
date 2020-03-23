<?php
 
//session_start();

//$user = $SESSION('id');
require __DIR__ . '/vendor/autoload.php';
use Google\Cloud\Datastore\DatastoreClient;
use Google\Cloud\Datastore\Entity;
use Google\Cloud\Datastore\EntityIterator;
use Google\Cloud\Datastore\Key;
use Google\Cloud\Datastore\Query\Query;

$query = $datastore->query()
->kind('User')
->projection(['Name'])
->filter('__key__', '>', $datastore->key('user', $user));
$name = $datastore->runQuery($query);

echo $name;

?>

<!DOCTYPE HTML>
<html>
<body>
<div>
<a href = "name.php">
 <button>"Change username"</button>
 </a>
</div>
<div>
 <a href = "password.php">
 <button>"Change password"</button>
 </a>
</div>
</body>
</html>