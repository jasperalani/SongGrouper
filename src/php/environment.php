<?php

$os = substr(php_uname(), 0, 5);
if ($os == 'Linux') {
    $_ENV = '000';
}else{
    $_ENV = 'local';
}