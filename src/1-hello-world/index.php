<?php

$v8 = new V8Js("PHPJS");

$javascriptWrapper = "PHPJS.output.result = function() { %s
}();";

$javascriptCode = <<<EOJS
var helloWorld = {
    oHai : "Hello World",
    aCalculation : (2 + 2)
};

return helloWorld;
EOJS;

try {
    $v8->output = new stdClass();
    $v8->executeString(sprintf($javascriptWrapper, $javascriptCode), 'example-1', V8Js::FLAG_FORCE_ARRAY);
    $returned = $v8->output->result;

}
catch (V8JsException $e) {
    $returned = [
        'error' => [
            'code' => $e->getCode(),
            'message' => $e->getMessage()
        ]
    ];
}

$phpCode = '
$v8 = new V8Js("PHPJS");
$javascriptWrapper = "PHPJS.output.result = function() { %s }();";
$v8->output = new stdClass();

$v8->executeString(sprintf($javascriptWrapper, $javascriptCode));
return $v8->output->result;
';

require dirname(__FILE__) . '/../helpers/view.php';
View::render($phpCode, $javascriptCode, var_export($returned, true));
