<?php
require_once __DIR__ .'/../inc/bootstrap.php';
requireAuth();

$bookTitle = request()->get('title');
$bookDescription = request()->get('description');

if (addTask($taskTitle, $bookDescription)) {
    $session->getFlashBag()->add('success', 'Task Added');
    redirect('/books.php');
} else {
    $session->getFlashBag()->add('error', 'Unable to Add Book');
    redirect('/add.php');
}
