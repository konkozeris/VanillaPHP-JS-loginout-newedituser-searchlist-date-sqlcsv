<?php
require_once('connection.php');
session_start();

$search = $_GET['q'];

$sql_all_users_search = "SELECT * FROM `users` 
WHERE `name` LIKE '%".$search."%' 
OR `last_name` LIKE '%".$search."%'
OR `email` LIKE '%".$search."%'";

$result = $conn->query($sql_all_users_search);

if (mysqli_num_rows($result) > 0) {

echo '<table class="table table-hover w-75 mx-auto">';
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

            $poked_name = $users['name'];

            $sql_poke_number = "SELECT COUNT(`to`) AS PokeNumber FROM `pokes` 
            WHERE `to` = '$poked_name'";
    
            $result_pokes = $conn->query($sql_poke_number);

            while($poke_number = mysqli_fetch_array($result_pokes)) {
                echo $poke_number['PokeNumber'];
            };
        echo "</td>";
        echo "<td>";
        echo "<button class='btn btn-primary' onclick='poke_user(this)' id='poke' data-id='".$users['id']."' data-name='".$users['name']."'>Poke</button>";
    echo "</tr>";
}
echo '</table>';
} else {
    echo "<span class='w-25 mx-auto'> No results found </span>";
}