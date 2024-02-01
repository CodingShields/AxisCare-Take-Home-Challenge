<?php
// Nothing needs to change in this file
class Rental
{
    private $movie;
    private $daysRented;
    // Constructor

    public function __construct(Movie $movie, int $daysRented)
    {
        $this->movie = $movie;
        $this->daysRented = $daysRented;
    }
    // Method to get the number of days rented

    public function getDaysRented(): int
    {
        return $this->daysRented;
    }

    // Method to get the movie
    public function getMovie(): Movie
    {
        return $this->movie;
    }
}
