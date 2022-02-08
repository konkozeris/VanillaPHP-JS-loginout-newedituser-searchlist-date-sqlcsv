<?php require_once('connection.php');
    session_start(); 

//table content

        $from = $_SESSION['email'];
        $search = $_GET['q'];
        $from_date = $_GET['from'];
        $to_date = $_GET['to'];

        if(!empty($_GET['q'])) {
            $sql_pokes_search = "SELECT DISTINCT `to` FROM `pokes` 
            WHERE `to` LIKE '%".$search."%' 
            AND `from` = '$from'
            AND `date` BETWEEN '$from_date' AND '$to_date'";
        } else {
            $sql_pokes_search = "SELECT DISTINCT `to` FROM `pokes` 
            WHERE `from` = '$from'
            AND `date` BETWEEN '$from_date' AND '$to_date'";
        }
        $result = $conn->query($sql_pokes_search);

        echo '<table class="table table-hover w-75 mx-auto table-sm">';
        echo '<thead>';
        echo '<th>To</th>';
        echo '<th>Pokes from you</th>';
        echo '<th>Date</th>';
        echo '</thead>';


        while($pokes = mysqli_fetch_array($result)) {
            echo "<tr>";
                echo "<td>".$pokes['to']."</td>";
                echo "<td>";

                    $poked_by_you = $pokes['to'];

                    $sql_poke_number = "SELECT COUNT(`to`) AS PokeNumber FROM `pokes` 
                    WHERE `from` = '$from' AND `to` = '$poked_by_you'";
            
                    $result_pokes = $conn->query($sql_poke_number);

                    while($poke_number = mysqli_fetch_array($result_pokes)) {
                        echo $poke_number['PokeNumber'];
                    };
                echo "</td>";
                echo "<td>";

                    $poked_by_you = $pokes['to'];

                    $sql_poke_date = "SELECT DISTINCT (`date`) AS poke_date FROM `pokes` 
                    WHERE `from` = '$from' AND `to` = '$poked_by_you'";
            
                    $result_poke_dates = $conn->query($sql_poke_date);

                    while($poke_date = mysqli_fetch_array($result_poke_dates)) {
                        echo $poke_date['poke_date'];
                    };

                echo "</td>";
            echo "</tr>";
        }
        echo '</table>';

?>