<?php



function config($name)
{
    $config_file = require '../config.php';
    return $config_file[$name];
}

function dd($obj)
{
    echo "<pre style='background: black; color: red; padding: 10px;'>";
    var_dump($obj);
    echo "</pre>";
    die;
}

function dump($obj)
{
    echo "<pre style='background: black; color: #fff; padding: 10px;'>";
    var_dump($obj);
    echo "</pre>";
}