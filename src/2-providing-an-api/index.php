<?php

$v8 = new V8Js();

$code = <<<EOJS
(function() {
    var helloWorld = {
        oHai : "Hello World",
        aCalculation : (2 + 2)
    };

    return calc;
}());
EOJS;

try {
    $returned = $v8->executeString($code);
}
catch (V8JsException $e) {
    $returned = json_encode([
        'error' => [
            'code' => $e->getCode(),
            'message' => $e->getMessage()
        ]
    ]);
}

require dirname(__FILE__) . '/../helpers/view.php';
View::render($code, $returned);
