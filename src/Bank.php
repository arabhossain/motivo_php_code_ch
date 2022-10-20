<?php

class Bank implements BankInterface
{
    //when php 8 could simplify it using named arguments
    private string $name;
    private string $account;
    private string $branchCode;
    private string $code;
    private string $endToEndId;
    private Amount $amount;

    public function __construct(
        string $name,
        string $account,
        string $branchCode,
        string $code,
        string $endToEndId,
        Amount $amount
    )
    {
        $this->name = $name;
        $this->account = $account;
        $this->branchCode = $branchCode;
        $this->code = $code;
        $this->endToEndId = $endToEndId;
        $this->amount = $amount;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    public function getAccount(): string
    {
        return $this->account;
    }

    /**
     * @return string
     */
    public function getBranchCode(): string
    {
        return $this->branchCode;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getEndToEndId(): string
    {
        return $this->endToEndId;
    }

    /**
     * @return Amount
     */
    public function getAmount(): Amount
    {
        return $this->amount;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            "amount" => $this->getAmount()->toArray(),
            "bank_account_name" => str_replace(" ", "_", strtolower($this->getName())),
            "bank_account_number" => $this->getAccount(),
            "bank_branch_code" => $this->getBranchCode(),
            "bank_code" => $this->getCode(),
            "end_to_end_id" => $this->getEndToEndId(),
        ];
    }
}
