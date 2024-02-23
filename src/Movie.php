<?php
// Price code strategy interface that implementing classes must follow
// Added 3 Strategies for the 3 types movie classes that are currently listed
// Adding another strategy for a new type of movie would go here and be implemented in the Movie class
// Each strategy, Regular, New Release and Childrens, has its own implementation of getCharge and getFrequentRenterPoints and returns the appropriate value
interface PriceCodeStrat
{
    // Returns the charge for a movie based on the number of days it was rented
    public function getCharge(int $daysRented): float;
    // Returns the frequent renter points for a movie based on the number of days it was rented
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
// Tested new code strategy for classic movies - it works 
// class ClassicPriceCodeStrat implements PriceCodeStrat
// {
//     public function getCharge(int $daysRented): float
//     {
//         $result = 2;
//         if ($daysRented > 2) {
//             $result += ($daysRented - 2) * 1.5;
//         }
//         return $result;
//     }

//     public function getFrequentRenterPoints(int $daysRented): int
//     {
//         return ($daysRented > 10) ? 2 : 1;
//     }
// }
class Movie
{
    private $title;
    private $priceCodeStrat;
// The Movie class now has a PriceCodeStrat object that is used to calculate the charge and frequent renter points
    public function __construct(string $title, PriceCodeStrat $priceCodeStrat)
    {
        $this->title = $title;
        $this->priceCodeStrat = $priceCodeStrat;
    }
// getCharge and getFrequentRenterPoints now call the PriceCodeStrat object's methods to calculate the charge and frequent renter points
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