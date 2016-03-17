<?php

ini_set('display_errors', true);

$v8 = new V8Js();

$code = <<<EOJS
(function() {
    var calc = 2 + 22;
    return calc;
}());
EOJS;

$returned = '';
try {
    $returned = $v8->executeString($code);
}
catch (V8JsException $e) {
    $returned = json_encode([
        'code' => $e->getCode(),
        'message' => $e->getMessage()
    ]);
}

require dirname(__FILE__) . '/../helpers/view.php';
View::render($code, $returned);