<?php 

include 'dbConnect.php';

function get_posts() {
    $pdo = dbConnect();
    $query = 'SELECT user_name, user_game1, user_game2, user_game3, user_discord, user_steam, user_img FROM `users`';
    $statement = $pdo->query( $query );
    return $statement;
}

function get_user() {
    $pdo = dbConnect();
    $query = 'SELECT user_name FROM `users`';
    $statement = $pdo->query( $query );
    $result = mysqli_query($pdo, $query);
    return $statement;

    $datas = array();
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)){
        $datas[] = $row;
        }
    }

    print_r($datas);

};

function isLoggedIn() {
    global $_SESSION;

    if (isset($_SESSION['id'])) {
        return true;
    } 
    return false;
}

function register($user_name, $user_email, $user_password, $user_game1, $user_game2, $user_game3, $user_discord, $user_steam, $user_img) {
    $pdo = dbConnect();
    $data = [$user_name, $user_email, $user_password, $user_game1, $user_game2, $user_game3, $user_discord, $user_steam, $user_img];
    $sql = "INSERT INTO users (user_name, user_email, user_password, user_game1, user_game2, user_game3, user_discord, user_steam, user_img) VALUES (?, ? ,?, ?, ?, ?, ?, ?, ?)";
    $pdo->prepare($sql)->execute($data);
    header('Location: index.php?page=home');
}