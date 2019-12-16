<?php

function vd($data)
{
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
}

function vde($data)
{
    vd($data);
    exit;
}
