<?php
//  Need to change statement per the new methods in Movie.php

class Customer
{
    private $name;
    private $rentals = array();

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function addRental(Rental $rental)
    {
        array_push($this->rentals, $rental);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function statement(): string
    {
        $totalAmount = 0;
        $frequentRenterPoints = 0;
        $result = "Rental Record for " . $this->getName() . "\n";

//         // determine amounts for each line
//         foreach ($this->rentals as $rental) {
//             $thisAmount = 0;

//             switch ($rental->getMovie()->getPriceCode()) {
//                 case Movie::REGULAR:
//                     $thisAmount += 2;
//                     if ($rental->getDaysRented() > 2)
//                         $thisAmount += ($rental->getDaysRented() - 2) * 1.5;
//                     break;
//                 case Movie::NEW_RELEASE:
//                     $thisAmount += $rental->getDaysRented() * 3;
//                     break;
//                 case Movie::CHILDRENS:
//                     $thisAmount += 1.5;
//                     if ($rental->getDaysRented() > 3)
//                         $thisAmount += ($rental->getDaysRented() - 3) * 1.5;
//                     break;
//             }

//             // add frequent renter points
//             $frequentRenterPoints++;

//             // add bonus for a two day new release rental
//             if (
//                 ($rental->getMovie()->getPriceCode() == Movie::NEW_RELEASE) &&
//                 $rental->getDaysRented() > 1
//             )
//                 $frequentRenterPoints++;

//             // show figures for this rental
//             $result .= "\t" . $rental->getMovie()->getTitle() . "\t" .
//                 $thisAmount . "\n";
//             $totalAmount += $thisAmount;
//         }
//         // Add H1 header with italics for the customer name
// // footer lines should each be in their own <p> elements
//         $result .= "Amount owed is " . $totalAmount . "\n";
//         $result .= "You earned " . $frequentRenterPoints .
//             " frequent renter points";

//         return $result;
//     }
interface PriceCodeStrategy {
    public function getCharge(int $daysRented): float;
    public function getFrequentRenterPoints(int $daysRented): int;
}

class RegularPriceCodeStrategy implements PriceCodeStrategy {
    public function getCharge(int $daysRented): float {
        $result = 2;
        if ($daysRented > 2) {
            $result += ($daysRented - 2) * 1.5;
        }
        return $result;
    }

    public function getFrequentRenterPoints(int $daysRented): int {
        return 1;
    }
}

class NewReleasePriceCodeStrategy implements PriceCodeStrategy {
    public function getCharge(int $daysRented): float {
        return $daysRented * 3;
    }

    public function getFrequentRenterPoints(int $daysRented): int {
        return ($daysRented > 1) ? 2 : 1;
    }
}

class ChildrensPriceCodeStrategy implements PriceCodeStrategy {
    public function getCharge(int $daysRented): float {
        $result = 1.5;
        if ($daysRented > 3) {
            $result += ($daysRented - 3) * 1.5;
        }
        return $result;
    }

    public function getFrequentRenterPoints(int $daysRented): int {
        return 1;
    }
}
class ClassicPriceCodeStrategy implements PriceCodeStrategy {
    public function getCharge(int $daysRented): float {
        $result = 2;
        if ($daysRented > 2) {
            $result += ($daysRented - 2) * 1.5;
        }
        return $result;
    }

    public function getFrequentRenterPoints(int $daysRented): int {
        return ($daysRented > 10) ? 2 : 1;
    }
}
class Movie {
    private $title;
    private $priceCodeStrategy;

    public function __construct(string $title, PriceCodeStrategy $priceCodeStrategy) {
        $this->title = $title;
        $this->priceCodeStrategy = $priceCodeStrategy;
    }

    public function getCharge(int $daysRented): float {
        return $this->priceCodeStrategy->getCharge($daysRented);
    }

    public function getFrequentRenterPoints(int $daysRented): int {
        return $this->priceCodeStrategy->getFrequentRenterPoints($daysRented);
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function setPriceCodeStrategy(PriceCodeStrategy $priceCodeStrategy) {
        $this->priceCodeStrategy = $priceCodeStrategy;
    }
}
}
