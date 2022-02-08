<?php require_once('connection.php');?>

<?php
            $email = $_SESSION['email'];

            $sql = "SELECT * FROM `pokes` 
            WHERE `to` = '$email'
            LIMIT 5";

            $result = $conn->query($sql);

            echo "<table class='table table-hover'>";
            echo "<tr>";
            echo '<td><a href="pokes.php">See your pokes</a></td>';
            echo "</tr>";

            while ($pokes = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo '<td>Poke nuo '.$pokes['from'].'</td>';
                echo "</tr>";

            }
            echo "</table>";
?>