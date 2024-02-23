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
        $result = '<div class="shadow-black shadow-2xl bg-gray-200 flex flex-col p-8  text-start w-max mx-auto my-auto border-4 border-black rounded-2xl mt-8">
                <h1 class="text-3xl font-sans text-center h-2">Axis Care Movie Rental<h1>
                <div class="text-lg text-start "><p class="mb-2">Rental Record: <span class="underline">' . $this->getName() . "</span>\n";

        foreach ($this->rentals as $rental) {
            $thisAmount = $rental->getMovie()->getCharge($rental->getDaysRented());

            $frequentRenterPoints += $rental->getMovie()->getFrequentRenterPoints($rental->getDaysRented());

            $result .= "<p class='h-1 text-blue-700 '> \t" . $rental->getMovie()->getTitle() . "\t" . $thisAmount . "</p>\n";

            $totalAmount += $thisAmount;
        }
        $result .= "
        <p>Amount Due:" . "<span class='text-red-500 '>\t$" . $totalAmount . "</span></p>\n";
        $result .= "Customer frequent renter points:" . "<span class='text-red-500'>" . $frequentRenterPoints . "</span>\n  
        </div>";

        return $result;
    }
    public function htmlStatement(): string
    {
        $totalAmount = 0.00;
        $frequentRenterPoints = 0.00;

        $result = "
        <div class='my-20 bg-gray-200 flex flex-col p-8 my-0 justify-start items-start text-start w-max mx-auto border-4 shadow-black shadow-2xl border-black rounded-lg'>
        <h1 class='text-3xl text-center'>Rental Record for <span class='italic'>" . $this->getName() . "</span></h1>
        <br>";

        foreach ($this->rentals as $rental) {
            $thisAmount = $rental->getMovie()->getCharge($rental->getDaysRented());

            $frequentRenterPoints += $rental->getMovie()->getFrequentRenterPoints($rental->getDaysRented());

            $result .= "<p class='text-center mt-2'>" . $rental->getMovie()->getTitle() . " - " . $thisAmount . "</p><br>";

            $totalAmount += $thisAmount;
        }

        $result .= "<div class='bg-gray-200 py-4 px-16 mx-auto border-2 border-black rounded-lg shadow-black shadow-xl'>
        <p class='underline'>Total Charge Amount: <span class='text-red-500 font-bold italic text-lg'> " . $totalAmount . "</span></p></div><br>";
        $result .= "<p
        class='mx-auto '
        
        >You earned <span class='text-red-500 font-bold italic text-lg '> " . $frequentRenterPoints . "</span> frequent renter points</p></div>";

        return $result;
    }
}