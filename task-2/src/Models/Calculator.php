<?php

namespace Calculator\Models;

use Calculator\ValueObject\CalculatorValueObject;

/**
 * Class Calculator
 */
class Calculator
{
    /**
     * @var float
     */
    private $basePrice;

    /**
     * @var int
     */
    private $basePriceChoice;

    /**
     * @var float
     */
    private $commission;

    /**
     * @var int
     */
    private $value;

    /**
     * @var int
     */
    private $instalments;

    /**
     * @var int
     */
    private $taxInput;

    /**
     * @param CalculatorValueObject $voCalculator
     */
    public function __construct(CalculatorValueObject $voCalculator)
    {
        $time = new \DateTime();
        $time = $time->setTimestamp($voCalculator->getTime());

        if ((($time->format('w') == '5') && ($time->format('H') > 14)) && ($time->format('H') < 20))
        {
            $this->basePrice = $voCalculator->getTotalValue() * 0.13;
            $this->basePriceChoice = 13;
        } else {
            $this->basePrice = $voCalculator->getTotalValue() * 0.11;
            $this->basePriceChoice = 11;
        }

        $this->value = $voCalculator->getTotalValue();
        $this->commission = $this->basePrice * 0.17;
        $this->tax = $voCalculator->getTax() / 100 * $this->basePrice;
        $this->instalments = $voCalculator->getInstalments();
        $this->taxInput = $voCalculator->getTax();
    }

    /**
     * @return array
     */
    public function doCalculate() : string
    {
        $payments = [];
        $vlBase = round($this->basePrice / $this->instalments, 2);
        $commission = round($this->commission / $this->instalments, 2);
        $tax = round($this->tax / $this->instalments, 2);

        for ($idx = 0; $idx < $this->instalments; $idx++) {
            if ($idx == $this->instalments - 1) {
                $vlBase = abs(round($this->basePrice - ($vlBase * ($this->instalments - 1)), 2));
                $commission = abs(round($this->commission - ($commission * ($this->instalments - 1)), 2));
                $tax = abs(round($this->tax - ($tax * ($this->instalments - 1)), 2));
            }
            $vlTotal = $vlBase + $commission + $tax;

            $payments[$idx] = [
                'basePrice' => number_format($vlBase, 2, '.', ''),
                'commission' => number_format($commission, 2, '.', ''),
                'tax' => number_format($tax, 2, '.', ''),
                'total' => number_format($vlTotal, 2, '.', ''),
            ];
        }
        return json_encode([
            'basePrice' => number_format($this->basePrice, 2, '.', ''),
            'commission' => number_format($this->commission, 2, '.', ''),
            'tax' => number_format($this->tax, 2, '.', ''),
            'total' => number_format(round($this->basePrice + $this->commission + $this->tax, 2), 2, '.', ''),
            'value' => number_format($this->value, 2, '.', ''),
            'basePriceChoice' => $this->basePriceChoice,
            'taxInput' => $this->taxInput,
            'payments' => $payments
        ]);
    }
}
