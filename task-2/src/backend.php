<?php

declare(strict_types=1);

namespace Calculator;

require_once './vendor/autoload.php';

use Calculator\Models\Calculator;
use Calculator\ValueObject\CalculatorValueObject;

header('Content-Type: application/json');

try {
    $voPolicy = new CalculatorValueObject($_POST);
    $policy = new Calculator($voPolicy);
    echo $policy->doCalculate();
} catch (\Exception $exp) {
    echo json_encode(['status' => 'error', 'message' => $exp->getMessage()]);
}
