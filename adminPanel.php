<?php
session_start();
require('db.php');

    if($_SESSION['role'] != 'admin') {
        header("location:index.php");
    }


?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        table td,tr{
            border: 1px solid white;
        }
        .img-thumb{
            max-height: 300px;
            max-width: 300px;
        }
        table a{
            color: white;
            
        }
        table td{
            padding: 10px;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            background: rgba(0, 0, 0, 0.8);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            color: var(--white);
        }

        form label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--white);
        }

        form input[type="text"],
        form textarea,
        form input[type="file"] {
            width: 100%;
            padding: 0.75rem;
            border: none;
            border-radius: 5px;
            background: #333;
            color: var(--white);
            margin-bottom: 1.5rem;
        }

        form input[type="text"]:focus,
        form textarea:focus,
        form input[type="file"]:focus {
            outline: none;
            background: #444;
        }

        form input[type="submit"] {
            width: 100%;
            padding: 0.75rem;
            margin-top: 1rem;
            border: none;
            border-radius: 5px;
            background: var(--main-color);
            color: var(--white);
            cursor: pointer;
            font-weight: 700;
            transition: background-color 0.5s;
        }

        form input[type="submit"]:hover {
            background-color: #5a37b9;
        }

        .admin-artists{
            display: grid;
            grid-template-columns: 70% 30%;
        }

        td ul{
            margin: 20px;
        }

    </style>
    <title>UME - Moje konto</title>
</head>
<body>
        <?php include("menu.php"); ?>


    <section class="page-container">
        <h2>Artyści</h2>
        <div class="admin-artists">
        <?php
                $sql = "SELECT * FROM artists";

                $result = $conn->query($sql);

                    
                if($result->num_rows > 0){
                    echo "    <table>
                    
                        <td>ID</td>
                        <td>Nazwa</td>
                        <td>Zdjęcie</td>
                        <td>Opis</td>
                        <td>Usuń</td>
                    </th>";
                    while($row = $result->fetch_object()) {
                        echo "<tr>";
                        echo "<td>$row->ID</td>";
                        echo "<td>$row->Name</td>";
                        echo "<td><img src='img/$row->Photo' class='img-thumb' /></td>";
                        echo "<td>$row->Description</td>";
                        echo "<td> <a href='delete_ticket.php?id=$row->ID'> Usuń </a></td>";
                        echo "</tr>";
                    }
                    echo "</table>";

                }   
                else{
                    echo "Wystąpił błąd - brak danych z tabeli!";
                }
                
            ?>

            <form action="add_artist.php" method="post" enctype="multipart/form-data">
                    <label for="name">Nazwa:</label>
                    <input type="text" id="name" name="name" required><br><br>
                    
                    <label for="description">Opis:</label>
                    <textarea id="description" name="description" required></textarea><br><br>
                    
                    <label for="photo">Zdjęcie:</label>
                    <input type="file" id="photo" name="photo" required><br><br>
                    
                    <input type="submit" value="Dodaj artystę">
            </form>
        </div>

        

        <h2>Bilety</h2>

        <div class="admin-artists">
        <?php
                $sql = "SELECT * FROM tickets";

                $result = $conn->query($sql);

                    
                if($result->num_rows > 0){
                    echo "    <table>
                    
                        <td>ID</td>
                        <td>Nazwa</td>
                        <td>Zawartość</td>
                        <td>Cena</td>
                        <td>Usuń</td>
                    </th>";
                    while($row = $result->fetch_object()) {
                        echo "<tr>";
                        echo "<td>$row->ID</td>";
                        echo "<td>$row->Name</td>";
                        echo "<td>$row->Included</td>";
                        echo "<td>$row->Price</td>";
                        echo "<td> <a href='delete_ticket.php?id=$row->ID'> Usuń </a></td>";
                        echo "</tr>";
                    }
                    echo "</table>";

                }   
                else{
                    echo "Wystąpił błąd - brak danych z tabeli!";
                }
                
            ?>

            <form action="add_ticket.php" method="post" enctype="multipart/form-data">
                    <label for="name">Nazwa:</label>
                    <input type="text" id="name" name="name" required><br><br>
                    
                    <label for="description">Opis (HTML, użyj ul)</label>
                    <textarea id="description" name="description" required></textarea><br><br>
                    
                    <label for="photo">Cena:</label>
                    <input type="text" id="price" name="price" required>
                    
                    <input type="submit" value="Dodaj bilet">
            </form>
        </div>

        <div class="delete-account">
            <h2>Zamówienia</h2>
            <?php

                $sql = "SELECT * FROM orders";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo "<table>
                        <tr>
                            <th>ID</th>
                            <th>ID użytkownika</th>
                            <th>Wartość zamówienia</th>
                            <th>Imię i nazwisko </th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Miasto</th>
                            <th>Poczta</th>
                            <th>Kod pocztowy</th>
                            <th>Delete</th>
                        </tr>";
                    
                    while ($row = $result->fetch_object()) {
                        echo "<tr>
                            <td>{$row->id}</td>
                            <td>{$row->user_id}</td>
                            <td>{$row->order_total}</td>
                            <td>{$row->fullname}</td>
                            <td>{$row->email}</td>
                            <td>{$row->address}</td>
                            <td>{$row->city}</td>
                            <td>{$row->post}</td>
                            <td>{$row->zip}</td>
                            <td><a href='delete_order.php?id={$row->id}'>Delete</a></td>
                        </tr>";
                    }
                    
                    echo "</table>";
                } else {
                    echo "Nie znaleziono zamówień!";
                }
            ?>

        </div>
    </section>

    <footer>
        <div class="event-info">
            <img src="./img/UME.png" alt="Logo" class="main-logo">
            <h2>Ultra Music Event</h2>
            <h3>Poznaj świat muzycznej rozpusty!</h3>
            <p>&copy; Kacper Ziubiński</p>
        </div>

        <div class="social">
            <a href="index.php">Strona główna</a>
            <a href="artist.php">Artyści</a>
            <a href="tickets.php">Bilety</a>
            <a href="myAccount.php">Moje konto</a>
        </div>
    </footer>
</body>
</html>
