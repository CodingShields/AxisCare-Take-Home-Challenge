<html>

<head>
  <title>Axis Movie Rental </title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css">
</head>


<body class="flex flex-col justify-center items-center min-h-screen">

  <?php
  $codedir = __DIR__ . '/../src';
  require_once("$codedir/Movie.php");
  require_once("$codedir/Customer.php");
  require_once("$codedir/Rental.php");

  $prognosisNegative = new Movie("Prognosis Negative", new NewReleasePriceCodeStrat());
  $sackLunch = new Movie("Sack Lunch", new ChildrensPriceCodeStrat());
  $painAndYearning = new Movie("The Pain and the Yearning", new RegularPriceCodeStrat());
  // $ninjaTurtlesReturnOfOoze = new Movie("Teenage Mutant Ninja Turtles", new ClassicPriceCodeStrat());
  

  $customer = new Customer("Susan Ross");

  $customer->addRental(new Rental($prognosisNegative, 3));
  $customer->addRental(new Rental($painAndYearning, 1));
  $customer->addRental(new Rental($sackLunch, 1));
  // $customer->addRental(new Rental($ninjaTurtlesReturnOfOoze, 20));
  
  // Generate the customer's statement
  $statement = $customer->statement();

  echo '<pre>';

  echo $statement;

  echo '</pre>';

  // Generate HTML statement
  $htmlStatement = $customer->htmlStatement();

  echo $htmlStatement;
  ?>
</body>

</html>