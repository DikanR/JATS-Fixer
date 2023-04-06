<?php

function importFile($file){
    $doc = new DOMDocument();
    $doc->formatOutput = true;
    $doc->preserveWhiteSpace = false;
    $doc->load($file);

    return $doc;
}

$imported = importFile('modified copy.xml');
$importedRoot = $imported->documentElement;

var_dump($imported->getElementsByTagName('ack')->item(0)->getElementsByTagName('p')->item(0)->lastChild);


?>