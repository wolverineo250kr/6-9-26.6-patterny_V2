<?php
require_once 'HTMLLineIterator.php';

$html = file_get_contents('template.html');
$iterator = new HTMLLineIterator($html);

$iterator->rewind();
while ($iterator->valid()) {
    $current = $iterator->current();

    echo $current . "\n";
    $iterator->next();
}

?>