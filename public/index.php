<html>

<head>
  <title>Axis Movie Rental </title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css">
</head>


<body class="bg-green-400">

  <?php
  $codedir = __DIR__ . '/../src';
  require_once("$codedir/Movie.php");
  require_once("$codedir/Customer.php");
  require_once("$codedir/Rental.php");

  $prognosisNegative = new Movie("Prognosis Negative", new NewReleasePriceCodeStrat());
  $sackLunch = new Movie("Sack Lunch", new ChildrensPriceCodeStrat());
  $painAndYearning = new Movie("The Pain and the Yearning", new RegularPriceCodeStrat());


  $customer = new Customer("Susan Ross");

  $customer->addRental(new Rental($prognosisNegative, 3));
  $customer->addRental(new Rental($painAndYearning, 1));
  $customer->addRental(new Rental($sackLunch, 1));

  // Generate the customer's statement
  $statement = $customer->statement();
  $movie = new Movie("Some Classic Movie", new ClassicPriceCodeStrat());
  echo '<pre>';
  echo '<div">
  <div class="shadow-black shadow-2xl bg-gray-200 flex flex-col p-8  text-start w-max mx-auto border-4 border-black rounded-lg">
  <h1 class="text-3xl font-sans text-center h-2">Axis Care Movie Rental<h1>
  <div class="text-lg text-start h-max ">' . $statement . '</div>
  </div>
  </div>';

  echo '</pre>';

  // Generate HTML statement
  $htmlStatement = $customer->htmlStatement();

  echo $htmlStatement;
  ?>
</body>

</html>