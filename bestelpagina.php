<!DOCTYPE html>
<link rel="stylesheet" href="style.css">
<?php
include __DIR__ . "/header.php"; ?>

<form method="post" action="confirm.php">

    <table style="height: 100%; width: 100%;">
        <tbody>
        <?php
        if (isset($_SESSION["voornaam"])) {
            $html = ' <tr>
            <td style="width: 50%;"><label for="voornaam">Voornaam:</label><br /> <input id="voornaam" name="voornaam" required="" type="text" value=' . $_SESSION["voornaam"] . ' </td>
            <td style="width: 50%;"><label for="postcode">Postcode:</label><br /> <input id="postcode" maxlength="7" name="postcode" required="" type="text" value=' . $_SESSION["postcode"] . ' </td>
        </tr>
        <tr>
            <td style="width: 50%;"><label for="tussenvoegsel">Tussenvoegsel:</label><br /> <input id="tussenvoegsel" name="tussenvoegsel" type="text" value=' . $_SESSION["tussenvoegsel"] . ' <br>
                <label for="achternaam">Achternaam:</label><br /> <input id="achternaam" name="achternaam" required="" type="text" value=' . $_SESSION["achternaam"] . ' </td>
            <td style="width: 50%;"><label for="huisnummer">Huisnummer:</label><br /> <input id="huisnummer" name="huisnummer" required="" type="number" value=' . $_SESSION["huisnummer"] . ' </td>
                <label for="toevoeging">Toevoeging:</label><br /> <input id="toevoeging" name="toevoeging" type="text" value=' . $_SESSION["toevoeging"] . ' </td>
        </tr>
        <tr>
            <td style="width: 50%;"><label for="telefoonnummer">Telefoonnummer:</label><br /> <input id="telefoonnummer" name="telefoonnummer" required="" type="tel" value=' . $_SESSION["telefoonnummer"] . ' </td>
            <td style="width: 50%;"><label for="woonplaats">Woonplaats:</label><br /> <input id="woonplaats" name="woonplaats" required="" type="text" value=' . $_SESSION["woonplaats"] . ' </td>
        </tr>
        <tr>
            <td style="width: 50%;"><label for="straatnaam">Straatnaam:</label><br /> <input id="straatnaam" name="straatnaam" required="" type="text" value=' . $_SESSION["straatnaam"] . ' </td>
            <td style="width: 50%;">    <label for="email">E-mailadres:</label><br>
                <input type="email" id="email" name="email" required value=' . $_SESSION["email"] . ' </td>
        </tr>
        <tr>
            <td style="width: 50%;"><button> <input type="submit" name="opslaan" class="btn btn-primary"> Opslaan en naar de volgende stap</button>
            </td>
            <td style="width: 50%;"><form method="post" action="cancel.php"> <button type="submit" name="cancel" class="btn btn-secondary" onclick="return confirm(`Weet je het zeker ? `)">Afbreken!</button></form>
            </td>
        </tr>';

            echo $html;
        } else {
            $html = ' <tr>
            <td style="width: 50%;"><label for="voornaam">Voornaam:</label><br /> <input id="voornaam" name="voornaam" required="" type="text"/></td>
            <td style="width: 50%;"><label for="postcode">Postcode:</label><br /> <input id="postcode" maxlength="7" name="postcode" required="" type="text"/></td>
        </tr>
        <tr>
            <td style="width: 50%;"><label for="tussenvoegsel">Tussenvoegsel:</label><br /> <input id="tussenvoegsel" name="tussenvoegsel" type="text"/><br>
                <label for="achternaam">Achternaam:</label><br /> <input id="achternaam" name="achternaam" required="" type="text"/></td>
            <td style="width: 50%;"><label for="huisnummer">Huisnummer:</label><br /> <input id="huisnummer" name="huisnummer" required="" type="number"/><br />
                <label for="toevoeging">Toevoeging:</label><br /> <input id="toevoeging" name="toevoeging" type="text"/></td>
        </tr>
        <tr>
            <td style="width: 50%;"><label for="telefoonnummer">Telefoonnummer:</label><br /> <input id="telefoonnummer" name="telefoonnummer" required="" type="tel"/></td>
            <td style="width: 50%;"><label for="woonplaats">Woonplaats:</label><br /> <input id="woonplaats" name="woonplaats" required="" type="text"/></td>
        </tr>
        <tr>
            <td style="width: 50%;"><label for="straatnaam">Straatnaam:</label><br /> <input id="straatnaam" name="straatnaam" required="" type="text"/></td>
            <td style="width: 50%;">    <label for="email">E-mailadres:</label><br>
                <input type="email" id="email" name="email" required ><br></td>
        </tr>
        <tr>
            <td style="width: 50%;"><button> <input type="submit" name="opslaan" class="btn btn-primary"> Opslaan en naar de volgende stap</button>
            </td>
            <td style="width: 50%;"><a href="cart.php"><input name="cancel" value=Annuleren! class="btn btn-secondary" onclick="return confirm(`Weet je het zeker?`)"></a>
            </td>
        </tr>';
            echo $html;
        }
        ?>
        </tbody>
    </table>
</form>


<?php
include __DIR__ . "/footer.php";

?>