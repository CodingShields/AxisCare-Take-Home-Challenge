<?php
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
        $totalAmount = 0.00;
        $frequentRenterPoints = 0;
        $result = "<p>Rental Record: <span class='underline'>" . $this->getName() . "</span>\n";

        foreach ($this->rentals as $rental) {
            $thisAmount = $rental->getMovie()->getCharge($rental->getDaysRented());

            $frequentRenterPoints += $rental->getMovie()->getFrequentRenterPoints($rental->getDaysRented());

            $result .= "\t<p class='h-2 text-blue-700 '> \t" . $rental->getMovie()->getTitle() . "\t" . $thisAmount . "</p>\n";

            $totalAmount += $thisAmount;
        }
        $result .= "Amount Due:" . "<span class='text-red-500'>\t$" . $totalAmount . "</span>\n";
        $result .= "Customer frequent renter points:" . "<span class='text-red-500'>" . $frequentRenterPoints . "</span>\n";

        return $result;
    }
    public function htmlStatement(): string
    {
        $totalAmount = 0.00;
        $frequentRenterPoints = 0.00;

        $result = "
        
        <h1 class='text-3xl text-center'>Rental Record for <span class='italic'>" . $this->getName() . "</span></h1><br>";

        foreach ($this->rentals as $rental) {
            $thisAmount = $rental->getMovie()->getCharge($rental->getDaysRented());

            $frequentRenterPoints += $rental->getMovie()->getFrequentRenterPoints($rental->getDaysRented());

            $result .= "<p class='text-center'>" . $rental->getMovie()->getTitle() . " - " . $thisAmount . "</p><br>";

            $totalAmount += $thisAmount;
        }

        $result .= "
        <div
        class='bg-gray-200 flex flex-col p-4 my-0 justify-start items-start text-start w-max mx-auto border-2 border-black rounded-lg'  
        >
        <p>Amount Due: <em> " . $totalAmount . "</em></p></div><br>";
        $result .= "<p>You earned <em>" . $frequentRenterPoints . "</em> frequent renter points</p>";

        return $result;
    }
}