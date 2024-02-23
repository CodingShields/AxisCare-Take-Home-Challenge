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
        $result ="Customer:\t" . $this->getName() . "\n";

        foreach ($this->rentals as $rental) {
            $thisAmount = $rental->getMovie()->getCharge($rental->getDaysRented());

            $frequentRenterPoints += $rental->getMovie()->getFrequentRenterPoints($rental->getDaysRented());

            $result .= "\t" . $rental->getMovie()->getTitle() . "\t" . $thisAmount . "\n";

            $totalAmount += $thisAmount;
        }
        $result .= "Amount Due:" . "\t$" . number_format($totalAmount, 2) . "\n";
        $result .= "Customer frequent renter points:" . $frequentRenterPoints . "\n";

        return $result;
    }
    public function htmlStatement(): string
    {
        $totalAmount = 0.00;
        $frequentRenterPoints = 0.00;

        $result = "
        <div class='bg-green-500 p-8 mt-10'>
        <div class='bg-gray-200 flex flex-col p-8 justify-start items-start text-start w-max mx-auto border-4 shadow-black shadow-2xl border-black rounded-lg'>
        <h1 class='text-3xl text-center'>Rental Record for <span class='italic'>" . $this->getName() . "</span></h1>
        <br>";

        foreach ($this->rentals as $rental) {
            $thisAmount = $rental->getMovie()->getCharge($rental->getDaysRented());

            $frequentRenterPoints += $rental->getMovie()->getFrequentRenterPoints($rental->getDaysRented());

            $result .= "<p class='text-center mt-2'>" . $rental->getMovie()->getTitle() . " - " . $thisAmount . "</p><br>";

            $totalAmount += $thisAmount;
        }

        $result .= "<div class='bg-gray-200 py-4 px-16 mx-auto border-2 border-black rounded-lg shadow-black shadow-xl'>
        <p>Total Charge Amount: <span class='text-red-500 font-bold italic text-lg'> $" . number_format($totalAmount, 2) . "</span></p></div><br>";
        $result .= "<p
        class='mx-auto '
        
        >You earned <span class='text-red-500 font-bold italic text-lg '> " . $frequentRenterPoints . "</span> frequent renter points</p></div></div>";

        return $result;
    }
}