<?php

interface AmountInterface
{
    public function getSubunits(): int;

    public function getCurrency(): string;

    public function toArray(): array;
}
