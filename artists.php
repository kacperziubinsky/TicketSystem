<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>UME - Ultra Music Event</title>
    <style>
        .tickets{
            background:linear-gradient(0deg, rgba(88, 45, 209, 0.9), rgba(6, 4, 10, 0.9)), url(img/126856.webp) !important;
            background-size: cover !important;
        }
        .artist-photo{
            max-height: 300px;
        }
    </style>
</head>
<body>
    <?php include("menu.php"); ?>


    <section class="artis-page">
        <h2>Poznaj artystów!</h2>
            <input id="myInput" type="text" placeholder="Wyszukaj..">

        <div class="artists">
            <?php
            require('db.php');
                $sql = "SELECT * FROM artists";

                $result = $conn->query($sql);

                    
                if($result->num_rows > 0){
                    while($row = $result->fetch_object()) {
                        echo "<div class='single-artist'>";
                        echo "<img class='artist-photo' src='img/$row->Photo' alt='{$row->Name}' />";
                        echo "<div class='content'>";
                        echo "<h2>$row->Name</h2>";
                        echo "<p class='white-text'>$row->Description</p>";
                        echo "</div>";
                        echo "</div>";
                    }

                }   
                else{
                    echo "Wystąpił błąd - brak danych z tabeli!";
                }
                
            ?>


        </div>

    </section>


    <section class="tickets">
        
    <?php
            require('db.php');
                $sql = "SELECT * FROM tickets";

                $result = $conn->query($sql);

                    
                if($result->num_rows > 0){
                    while($row = $result->fetch_object()) {
                        echo "<div class='ticket-info'>";
                        echo "<h3>Bilet <span class='color'>$row->Name</span></h3>";
                        echo "$row->Included";
                        echo "</div>";
                    }
                }   
                else{
                    echo "Wystąpił błąd - brak danych z tabeli!";
                }
                
        ?>

    </section>


    <footer>
        <div class="event-info">
            <img src="./img/UME.png" alt="Logo" class="main-logo">
            <h2>Ultra Music Event</h2>
            <h3>Poznaj świat muzycznej rozpusty!</h3>
            <p>&copy;	Kacper Ziubiński</p>
        </div>

        <div class="social">
            <a href="">Strona główna</a>
            <a href="">Artyści</a>
            <a href="">Bilety</a>
            <a href="">Moje konto</a>

        </div>
    </footer>

    <script>
        $(document).ready(function(){
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $(".single-artist").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
</body>
</html>
