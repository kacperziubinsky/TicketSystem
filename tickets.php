<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>UME - Ultra Music Event</title>
</head>
<body>
<?php include("menu.php"); ?>


    <section class="tickets">
        


        <?php
            require('db.php');
            $sql = "SELECT * FROM tickets";
            $result = $conn->query($sql);

            if($result->num_rows > 0){
                while($row = $result->fetch_object()) {
                    echo "<div class='ticket-info'>";
                    echo "<h3>Bilet <span class='color'>{$row->Name}</span></h3>";
                    echo "{$row->Included}";
                    echo "<span class='price'>{$row->Price}</span> <br/>";
                    echo "<label for='quantity-standard'>Ilość:</label>";
                    echo "<input type='number' id='quantity-{$row->Name}' value='1' min='1'>";
                    echo "<button onclick=\"addToCart('Bilet {$row->Name}', 'quantity-{$row->Name}', {$row->Price})\">Dodaj do koszyka</button>";
                    echo "</div>";
                }
            } else {
                echo "Wystąpił błąd - brak danych z tabeli!";
            }
        ?>

        


    </section>

    <section class="info">
        <h2>Poznaj artystów!</h2>
        

        <?php
            require('db.php');
                $sql = "SELECT * FROM artists";

                $result = $conn->query($sql);

                    
                if($result->num_rows > 0){
                  echo "        <div class='swiper-container'>
            <div class='swiper-wrapper'>";
                    while($row = $result->fetch_object()) {
                        echo "<div class='swiper-slide'> ";
                        echo "<img src='$row->Photo'>";
                        echo "<div class='content'>";
                        echo "<h2>$row->Name</h2>";
                        echo "<p class='white-text'>$row->Description</p>";
                        echo "</div>";
                        echo "</div>";
                    }
                    echo "</div></div>";
                }   
                else{
                    echo "Wystąpił błąd - brak danych z tabeli!";
                }
                
            ?>

 

        <a href="" class="btn" style="font-size: 32px;">Kup bilety</a>
    </section>

    <script>
    
        const swiper = new Swiper('.swiper-container', {
            slidesPerView: 3,
            spaceBetween: 30,
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
        });
    </script>

    <footer>
        <div class="event-info">
            <img src="./img/UME.png" alt="Logo" class="main-logo">
            <h2>Ultra Music Event</h2>
            <h3>Poznaj świat muzycznej rozpusty!</h3>
            <p>&copy;	Kacper Ziubiński</p>
        </div>

        <div class="social">
            <a href="index.php">Strona główna</a>
            <a href="artist.php">Artyści</a>
            <a href="tickets.php">Bilety</a>
            <a href="myAccount.php">Moje konto</a>

        </div>
    </footer>
    <script src="./scripts/alert.js"></script>
    <script src="./scripts/addCart.js"></script>
    

</body>
</html>
