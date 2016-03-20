<?php

$v8 = new V8Js('PHPJS');

$codeTemplate = "PHPJS.output.result = function() { %s
}();";

$code = <<<EOJS
var helloWorld = {
    oHai : "Hello World",
    aCalculation : (2 + 2)
};

return helloWorld;
EOJS;

try {
    $v8->output = new stdClass();
    $v8->executeString(sprintf($codeTemplate, $code), 'example-1', V8Js::FLAG_FORCE_ARRAY);
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

require dirname(__FILE__) . '/../helpers/view.php';
View::render($code, var_export($returned, true));
