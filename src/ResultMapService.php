<?php

class ResultMapService
{
    //row index mapping for Bank object
    private const rowMapsBank = [
        'name' => 7,
        'account' => 6,
        'branchCode' => 2,
        'code' => 0,
        'endToEndId' => [10, 11],
    ];

    //row index mapping for Amount object
    private const rowMapsAmount = [
        'currency' => 0,
        'amount' => 8,
    ];

    /**
     * @param array $rawContents
     * @return array
     */
    public function getResult(array $rawContents): array
    {
        $mappedResults = [];
        $currency = $rawContents['header'][self::rowMapsAmount['currency']];

        foreach ($rawContents['rows'] as $row)
            $mappedResults[] = (new Bank(
                $this->getValue($row[self::rowMapsBank['name']]),
                $this->getValue($row[self::rowMapsBank['account']], 'Bank account number missing'),
                $this->getValue($row[self::rowMapsBank['branchCode']], 'Bank branch code missing'),
                $this->getValue($row[self::rowMapsBank['code']]),
                $this->getEndToEndId($row),
                (new Amount(
                     $currency,
                    $row[self::rowMapsAmount['amount']] ?? 0
                ))
            ))->toArray();

        return array_filter($mappedResults);
    }

    /**
     * @param $value
     * @param string $returnOnEmpty
     * @return mixed|string
     */
    private function getValue($value, string $returnOnEmpty = '')
    {
        return !empty($value) ? $value : $returnOnEmpty;
    }

    /**
     * @param array $row
     * @return string
     */
    private function getEndToEndId(array $row): string
    {
        $colValue = implode('', array_map(function ($index) use ($row) {
            $value = '';
            if (isset($row[$index]) && !empty($row[$index]))
                $value = $row[$index];

            return $value;
        }, self::rowMapsBank['endToEndId']));

        return $this->getValue($colValue, 'End to end id missing');
    }
}
