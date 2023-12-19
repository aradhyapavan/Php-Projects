<?php

require_once ('vendor/autoload.php');
use \Statickidz\GoogleTranslate;

$source = 'kn';
$target = 'en';
$text = $mkk;

$trans = new GoogleTranslate();
$result2 = $trans->translate($source,$target,$text);

?>