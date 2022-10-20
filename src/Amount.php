<?php


class Amount implements AmountInterface
{
    private string $currency;
    private float $amount;

    public function __construct(
        string $currency,
        string $amount
    )
    {
        $this->currency = $currency;
        $this->amount = (float)$amount;
    }

    /**
     * @return int
     */
    public function getSubunits(): int
    {
        return (int)($this->amount * 100);
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            "currency" => $this->getCurrency(),
            "subunits" => $this->getSubunits()
        ];
    }
}
