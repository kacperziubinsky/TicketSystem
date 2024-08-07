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


    <section class="banner">
        <div class="banner-text">
            <h2>Ultra Music Event</h2>
            <h3>Poznaj świat muzycznej rozpusty!</h3>
            <p>UME to największe wydarzenie w regionie!</p>
            <p id="artistTitle"></p>
            <p id="stageTitle"></p>
            <p id="barsTitle"></p>

        </div>
        <div class="banner-image">
            <img src="img/bg.webp" alt="">
        </div>
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

    <section class="about">

        <div class="text">
            <h2>UME to gwarant dobrej zabawy!</h2>
            <p>Działamy w branży muzycznej od ponad 10 lat, w tym czasie mieliśmy okazję współtworzyć olbrzymie wydarzenia!</p>
        </div>

        <div class="photo">
            <img src="img/show.webp" alt="" class="single-image"> 
        </div>

        <div class="photo">
            <img src="img/590.webp" alt="" class="single-image"> 
        </div>


        <div class="text">
            <h2>Muzyka ma łączyć...</h2>
            <p>To własnię to założenie przyświeca nam w budowie naszych wydarzeń! Na naszym festiwalu każdy znajdzie coś dla siebie, zatopi się zarazem w różnorodności brzmień!</p>
        </div>


    </section>


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


    <script>
        const artists = '10 artystów';
        const stages = '3 sceny';
        const bars = '8 barów';
        let speed = 50;

        function typeWriter(txt, elementId) {
            let i = 0; 
            function type() {
                if (i < txt.length) {
                    document.getElementById(elementId).innerHTML += txt.charAt(i);
                    i++;
                    setTimeout(type, speed);
                }
            }
            type();
        }
        
        window.onload = function() {
            setTimeout(function() {
                typeWriter(artists, 'artistTitle');
            }, 2000); 
            setTimeout(function() {
                typeWriter(stages, 'stageTitle');
            }, 5000);
            setTimeout(function() {
                typeWriter(bars, 'barsTitle');
            }, 7000);
        };

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
</body>
</html>
