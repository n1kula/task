<?php

use Emag\Lib\Getter\HttpGetter;
use Emag\Lib\Parser\EmagSchemaPriceParser;

require_once "vendor/autoload.php";

$parser = new EmagSchemaPriceParser('./xml/example.xml');
$parser->parse();

