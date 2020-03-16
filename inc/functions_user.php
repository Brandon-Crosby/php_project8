<?php
/*
 * Functions to interface with `user` table
 */
function getAllUsers()
{
    global $db;

    try {
        $query = "SELECT * FROM users";
        $query = $db->prepare($query);
        $query->execute();
        return $query->fetchAll();
    } catch (\Exception $e) {
        throw $e;
    }
}
function findUserByUsername($username)
{
    global $db;

    try {
        $query = "SELECT * FROM users WHERE username = :username";
        $query = $db->prepare($query);
        $query->bindParam(':username', $username);
        $query->execute();
        return $query->fetch();

    } catch (\Exception $e) {
        throw $e;
    }
}

function findUserById($userId)
{
    global $db;

    try {
        $query = $db->prepare("SELECT * FROM users WHERE id = :userId");
        $query->bindParam(':userId', $userId);
        $query->execute();
        return $query->fetch();

    } catch (\Exception $e) {
        throw $e;
    }
}

function createUser($username, $password)
{
    global $db;

    try {
        $query = $db->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        $query->bindParam(':username', $username);
        $query->bindParam(':password', $password);
        $query->execute();
        return findUserByUsername($username);
    } catch (\Exception $e) {
        throw $e;
    }
}
function updatePassword($password, $userId)
{
    global $db;

    try {
        $query = $db->prepare('UPDATE users SET password = :password WHERE id = :userid');
        $query->bindParam(':password', $password);
        $query->bindParam(':userid', $userId);
        $query->execute();
    } catch (\Exception $e) {
      throw $e;
 }

 return true;
}
