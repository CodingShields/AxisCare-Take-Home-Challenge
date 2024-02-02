<?php

interface PriceCodeStrat
{
    public function getCharge(int $daysRented): float;
    public function getFrequentRenterPoints(int $daysRented): int;
}

class RegularPriceCodeStrat implements PriceCodeStrat
{
    public function getCharge(int $daysRented): float
    {
        $result = 2;
        if ($daysRented > 2) {
            $result += ($daysRented - 2) * 1.5;
        }
        return $result;
    }

    public function getFrequentRenterPoints(int $daysRented): int
    {
        return 1;
    }
}

class NewReleasePriceCodeStrat implements PriceCodeStrat
{
    public function getCharge(int $daysRented): float
    {
        return $daysRented * 3;
    }

    public function getFrequentRenterPoints(int $daysRented): int
    {
        return ($daysRented > 1) ? 2 : 1;
    }
}

class ChildrensPriceCodeStrat implements PriceCodeStrat
{
    public function getCharge(int $daysRented): float
    {
        $result = 1.5;
        if ($daysRented > 3) {
            $result += ($daysRented - 3) * 1.5;
        }
        return $result;
    }

    public function getFrequentRenterPoints(int $daysRented): int
    {
        return 1;
    }
}
class ClassicPriceCodeStrat implements PriceCodeStrat
{
    public function getCharge(int $daysRented): float
    {
        $result = 2;
        if ($daysRented > 2) {
            $result += ($daysRented - 2) * 1.5;
        }
        return $result;
    }

    public function getFrequentRenterPoints(int $daysRented): int
    {
        return ($daysRented > 10) ? 2 : 1;
    }
}
class Movie
{
    private $title;
    private $priceCodeStrat;

    public function __construct(string $title, PriceCodeStrat $priceCodeStrat)
    {
        $this->title = $title;
        $this->priceCodeStrat = $priceCodeStrat;
    }

    public function getCharge(int $daysRented): float
    {
        return $this->priceCodeStrat->getCharge($daysRented);
    }

    public function getFrequentRenterPoints(int $daysRented): int
    {
        return $this->priceCodeStrat->getFrequentRenterPoints($daysRented);
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setPriceCodeStrategy(PriceCodeStrat $priceCodeStrat)
    {
        $this->priceCodeStrat = $priceCodeStrat;
    }
}
