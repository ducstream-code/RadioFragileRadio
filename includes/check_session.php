<?php
if (!session_id()){
    session_name('LCID');
    session_start();
}

if(isset($_COOKIE['id']) && !empty($_COOKIE['id']) && isset($_COOKIE['password']) && !empty($_COOKIE['password']) && isset($_COOKIE['role']) && !empty($_COOKIE['role'])) {
    setcookie('id', $_COOKIE['id'], time()+60*60*24*30, '/');
    setcookie('password', $_COOKIE['password'], time()+60*60*24*30, '/');
    setcookie('role', $_COOKIE['role'], time()+60*60*24*30,'/');

}

function checkLoggedUser(){
    if (isset($_COOKIE['id']) && !empty($_COOKIE['id']) && isset($_COOKIE['password']) && !empty($_COOKIE['password'])) {
        try {
            $sql = "SELECT id FROM users WHERE id = :id AND password = :password;";
            $stmt = $GLOBALS['db']->prepare($sql);
            $stmt->bindParam(':id', $_COOKIE['id']);
            $stmt->bindParam(':password', $_COOKIE['password']);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e);
        }
    }
    return false;
}