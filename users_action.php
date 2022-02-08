<?php require_once('connection.php'); ?>

        <?php 

        $limit = 15;

        $page = $_GET['page'];
        if($page < 1) {
            $page = 1;
        }

        $start = ($page - 1) * $limit;

        $sql_all_users = "SELECT * FROM users LIMIT $start, $limit";

        $result = $conn->query($sql_all_users);


        $tr = "SELECT COUNT(id) FROM users";
        $tr = mysqli_query($conn, $tr);
        $tr = mysqli_fetch_row($tr);

        $total_rows = $tr[0];

        $total_pages = ceil($total_rows / $limit);
        if($total_pages < 1) {
            $total_pages = 1;
        }

        echo '<table class="table table-hover w-75 mx-auto table-sm">';
        echo '<thead>';
        echo '<th>Name</th>';
        echo '<th>Surname</th>';
        echo '<th>Email</th>';
        echo '<th>Poke count</th>';
        echo '<th></th>';
        echo '</thead>';


        while($users = mysqli_fetch_array($result)) {
            echo "<tr>";
                echo "<td class='d-none' name='user_id'>".$users['id']."</td>";
                echo "<td>".$users['name']."</td>";
                echo "<td>".$users['last_name']."</td>";
                echo "<td>".$users['email']."</td>";
                echo "<td id='poke_number".$users['id']."'>";

                    $poked_email = $users['email'];

                    $sql_poke_number = "SELECT COUNT(`to`) AS PokeNumber FROM `pokes` 
                    WHERE `to` = '$poked_email'";
            
                    $result_pokes = $conn->query($sql_poke_number);

                    while($poke_number = mysqli_fetch_array($result_pokes)) {
                        echo $poke_number['PokeNumber'];
                    };
                echo "</td>";
                echo "<td>";
                echo "<button class='btn btn-primary' onclick='poke_user(this)' id='poke' data-email='".$users['email']."' data-id='".$users['id']."' data-name='".$users['name']."'>Poke</button>";
            echo "</tr>";
        }
        echo '</table>';

        echo '<div id="pagination" class="w-50 mx-auto">';

        if(!empty($total_pages)) {
        
            for($i=1; $i <= $total_pages; $i++) {

                echo "<button class='btn btn-light' onclick='usersTable(".$i.")' id='page".$i."' data-id=".$i.">".$i."</button>";
            }
        }

        echo "</div>";