<?php

namespace Calculator\ValueObject;

/**
 * Class CalculatorValueObject
 */
class CalculatorValueObject
{
    /**
     * @var int
     */
    private $tax;
    /**
     * @var int
     */
    private $instalments;
    /**
     * @var int
     */
    private $totalValue;

    /**
     * @var int
     */
    private $time;

    public function __construct(array $request)
    {
        $totalValue = (int) $request['value'];
        $tax = (int) $request['tax'];
        $instalments = (int) $request['instalments'];
        $time = (int) $request['time'];
        
        if ($tax > 100) 
        {
            throw new \InvalidArgumentException('Tax should not be between greater than 100');
        }

        if (!($instalments > 0 && $instalments <= 12)) 
        {
            throw new \InvalidArgumentException('instalments should be between 1 and 12');
        }

        if (!($totalValue >= 100 && $totalValue <= 100000)) 
        {
            throw new \InvalidArgumentException('Total value should be between 100 and 100000');
        }

        $this->tax = $tax;
        $this->instalments = $instalments;
        $this->totalValue = $totalValue;
        $this->time = $time;
    }

    public function getTax(): float
    {
        return $this->tax;
    }

    public function getTime(): int
    {
        return $this->time;
    }

    public function getInstalments(): int
    {
        return $this->instalments;
    }

    public function getTotalValue(): int
    {
        return $this->totalValue;
    }
}