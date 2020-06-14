<?php

include 'dbConnect.php';

function get_posts()
{
    $pdo = dbConnect();
    $query = 'SELECT user_name, user_game1, user_game2, user_game3, user_discord, user_steam, user_img FROM `users`';
    $statement = $pdo->query($query);
    return $statement;
}

function get_user()
{
    $pdo = dbConnect();
    $query = 'SELECT user_name FROM `gebruiker`';
    $statement = $pdo->prepare($query);
    $statement->execute();

    $user_data = $statement->fetchAll();

    return json_encode(array_values($user_data));
};

function isLoggedIn()
{
    global $_SESSION;

    if (isset($_SESSION['id'])) {
        return true;
    }
    return false;
}

function register($user_name, $user_email, $user_password, $user_game1, $user_game2, $user_game3, $user_discord, $user_steam, $user_img)
{
    $pdo = dbConnect();
    $data = [$user_name, $user_email, $user_password, $user_game1, $user_game2, $user_game3, $user_discord, $user_steam, $user_img];
    $sql = "INSERT INTO gebruiker (user_name, user_email, user_password, user_game1, user_game2, user_game3, user_discord, user_steam, user_img) VALUES (?, ? ,?, ?, ?, ?, ?, ?, ?)";
    $pdo->prepare($sql)->execute($data);
    header('Location: index.php?page=home');
}
