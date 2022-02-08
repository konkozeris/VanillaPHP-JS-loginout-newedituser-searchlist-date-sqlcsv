<?php require_once('connection.php');
    session_start(); ?>

        <?php 

// pagination

        $limit = 15;

        $page = $_GET['page'];
        if($page < 1) {
            $page = 1;
        }

        $from = $_SESSION['email'];

        $start = ($page - 1) * $limit;
        
        $tr = "SELECT COUNT( DISTINCT `to`) FROM pokes WHERE `from` = '$from'";
        $tr = mysqli_query($conn, $tr);
        $tr = mysqli_fetch_row($tr);

        $total_rows = $tr[0];
 
        $total_pages = ceil($total_rows / $limit);
        if($total_pages < 1) {
            $total_pages = 1;
        }

//table content

        $sql_pokes = "SELECT DISTINCT `to` FROM pokes WHERE `from` = '$from'
        LIMIT $start, $limit";
        $sql_dates = "SELECT `date` FROM pokes WHERE `from` = '$from'
        LIMIT $start, $limit";

        $result_dates = $conn->query($sql_dates);

        $result = $conn->query($sql_pokes);

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

        echo '<div id="pagination" class="w-50 mx-auto">';

        if(!empty($total_pages)) {
        
            for($i=1; $i <= $total_pages; $i++) {
                
                echo "<button class='btn btn-light' onclick='pokesTable(".$i.")' id='page".$i."' data-id=".$i.">".$i."</button>";
            }
        }

        echo "</div>";