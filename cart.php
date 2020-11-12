<?php
include __DIR__ . "/header.php";
$Connection = mysqli_connect("localhost", "root", "", "nerdygadgets");
mysqli_set_charset($Connection, 'latin1');

// Opzet winkelwage word als volgt:
// Ilias maakt een array in de session met de volgende opzet:
// $winkelwagen = array(42 => 1, 33 => 2)
// De key is het productnummer en de value is het aantal.


//TIJDELIJKE VARIABELE VOOR ITEMS IN DE MAND!!!
$_SESSION["cart"] = array(1 => 10, 2 => 20, 3 => 30);


//test



//Variabelen:
$totaalPrijs = 0;
$teller = 0;





$subtotaal = 0;
$btwWaarde = 0;

if(isset($_SESSION["cart"])) {


    print '<table><tr>
           <th>Verwijder product</th>
           <th>Productnaam</th>
           <th>Aantal</th>
           <th>Prijs</th>
           </tr>';



    foreach ($_SESSION["cart"] as $productnummer => $aantal) {
        $teller ++;

        print "<tr><th><form method='post'><input type='submit' name='";
        print "verwijder$productnummer";
        print "' value='🗑️'></form></th>";

        if (isset($_POST["verwijder$productnummer"])){
            $_SESSION["cart"][$productnummer] = NULL;
            print_r ($_SESSION["cart"]);
        }

        $query = "SELECT StockItemName, (RecommendedRetailPrice*(1+(TaxRate/100))) AS SellPrice
                     FROM StockItems
                     WHERE StockItemID = ?";

        $Statement = mysqli_prepare($Connection, $query);
        mysqli_stmt_bind_param($Statement, "i", $productnummer);
        mysqli_stmt_execute($Statement);
        $R = mysqli_stmt_get_result($Statement);
        $R = mysqli_fetch_all($R, MYSQLI_ASSOC);

        print '<th>';
        print ($R[0]["StockItemName"]);
        print '</th>';
        print '<th>';
        print "$aantal";
        print '</th>';
        print '<th>';
        print round(($R[0]["SellPrice"]),2) * $aantal;
        print '</th></tr>';

        $totaalPrijs = $totaalPrijs + round(($R[0]["SellPrice"]),2) * $aantal;
        $btwWaarde = $btwWaarde + ($R[0]["TaxRate"]);
        $subtotaal = $subtotaal + ($R[0]["RecommendedRetailPrice"]);
    }
    print '<th>';
    print "Subtotaal: " . $subtotaal;
    print '</th></tr>';
    print '<th>';
    print "BTW: " . $btwWaarde;
    print '</th></tr>';
    print '<th>';
    print "Totaalprijs: " . $totaalPrijs;
    print '</th></tr>';
}
else{
    print 'Er zit niks in de winkelmand!';
}

//<html>
//<input type=button name="bestellen" onClick="location.href='bestelpagina.php'" value="Bestellen">
//</html>
