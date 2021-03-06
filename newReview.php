<?php
include __DIR__ . "/header.php";
include __DIR__ . "/connect.php";

$revPlaced = FALSE;

if (isset($_POST['save'])) {
    $_SESSION['rated'] = $_POST['ratedIndex'];
}

if (isset($_POST['aanbeveling'])) {
    $Aanbeveling = 1;
} else {
    $Aanbeveling = 0;
}

if (isset($_POST['submit'])) {
    $newRating = $_SESSION['rated'] + 1;
    $query = "INSERT INTO `webshop_review`(`customerID`, `Stars`, `Datum`, `Aanbeveling`, `Reviewtext`, `StockItemID`) VALUES (?,?,?,?,?,?)";
    $Statement = mysqli_prepare($Connection, $query);
    $datum = date("Y-m-d");
    mysqli_stmt_bind_param($Statement, "iisisi", $_SESSION["customerID"], $newRating, $datum, $Aanbeveling, $_POST['ReviewText'], $_POST["stockItem"]);
    mysqli_stmt_execute($Statement);
    $R = mysqli_stmt_get_result($Statement);

    $revPlaced = TRUE;

}
$html = '';

if ($revPlaced == FALSE) {
    $html .= '

    <div class="container">
            <script src="https://www.google.com/recaptcha/api.js?render=6Lc1ffcZAAAAACvSDVgmKbgKBUapYoWdlHvhwScK"></script>
        <div class="row">
            <div class="col-12">
                <div class="place-review">
                    <form class="form" action="newReview.php" method="post">
                        <h2>Schrijf een review</h2>
                        <p>Hoeveel sterren geef je het product?</p>
                        <div class="star-box" style="cursor: pointer; font-size: 1.4em" >
                            <i class="fas fa-star" data-index="0"></i>
                            <i class="fas fa-star" data-index="1"></i>
                            <i class="fas fa-star" data-index="2"></i>
                            <i class="fas fa-star" data-index="3"></i>
                            <i class="fas fa-star" data-index="4"></i>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input inputType" id="exampleCheck1" name="aanbeveling" >
                            <label class="form-check-label" for="exampleCheck1">Beveel je dit product aan?</label>
                        </div>
                        <input type="hidden" name="stockItem" value=' . $_GET['stockitemID'] . '>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Wat vind je van het product?</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="ReviewText"
                                      required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit" data-sitekey="reCAPTCHA_site_key"
                            data-callback="onSubmit"
                            data-action="submit">Submit</button>
                </div>
            </div>
        </div>
    </div>
    ';
    echo $html;
} else {
    ?>
    <div class="container">
        <div class="row">
            <div class="form-group" style="margin: 100px auto;">
                <label for="exampleFormControlInput1">Je review is geplaatst! </label>
                <a href="index.php"><input type="button" class="btn btn-primary" id="exampleFormControlInput1"
                                           value=" Ga terug"></a>
            </div>

        </div>
    </div>
<?php }
?>
    <script src="https://www.google.com/recaptcha/api.js"></script>


    <script>
        function onSubmit(token) {
            document.getElementById("demo-form").submit();
        }
        function onClick(e) {
            e.preventDefault();
            grecaptcha.ready(function() {
                grecaptcha.execute('reCAPTCHA_site_key', {action: 'submit'}).then(function(token) {
                    // Add your logic to submit to your backend server here.
                });
            });
        }
        var ratedIndex = -1, uID = 0;
        $(document).ready(function () {
            resetStarColors()
            $('.fa-star').on('click', function () {
                ratedIndex = parseInt($(this).data('index'));
                localStorage.setItem('ratedIndex', ratedIndex)
                saveToTheDB();
            })
            $('.fa-star').mouseover(function () {
                resetStarColors()
                var currentIndex = parseInt($(this).data('index'));
                setStars(currentIndex)

            })
            $('.fa-star').mouseleave(function () {
                resetStarColors()
                if (ratedIndex != -1)
                    setStars(ratedIndex)
            })
        });
        function saveToTheDB() {
            $.ajax({
                url: "newReview.php",
                method: "POST",
                dataType: 'json',
                data: {
                    save: 1,
                    uID: uID,
                    ratedIndex: ratedIndex
                }, success: function (r) {
                    uID = r.uid
                }
            })
        }
        function setStars(max) {
            for (var i = 0; i <= max; i++)
                $('.fa-star:eq(' + i + ')').css('color', 'yellow')
        }
        function resetStarColors() {
            $('.fa-star').css('color', 'white');
        }
    </script>

