<?php

$router->add('', null, 'MainController');

$router->add('test/function', function()
{
    return '<b>funzt!</b>';
});
