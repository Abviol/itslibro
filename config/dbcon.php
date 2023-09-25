<?php

require __DIR__.'/vendor/autoload.php';

use Kreait\Firebase\Factory;

$factory = (new Factory)
   ->withServiceAccount('itslibro-af25a-firebase-adminsdk-l77mg-d0e02be64a.json')
   ->withDatabaseUri('https://console.firebase.google.com/u/0/project/itslibro-af25a/database/itslibro-af25a-default-rtdb/data/~2F');
   
$database = $factory->createDatabase();
?>