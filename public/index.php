<?php
require '../app/helpers.php';
require '../app/QueryBuilder.php';

$db = new QueryBuilder(config('host'), config('dbname'), config('username'), config('password'));
dump(config('dbname'));
dd(config('dbname'));
echo config('dbname');