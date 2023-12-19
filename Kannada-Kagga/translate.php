<?php

require_once ('vendor/autoload.php');
use \Statickidz\GoogleTranslate;

$source = 'en';
$target = 'kn';
$text = $mke;

$trans = new GoogleTranslate();
$result = $trans->translate($source,$target,$text);

?>