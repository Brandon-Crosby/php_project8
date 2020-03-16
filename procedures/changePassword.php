<?php
require_once __DIR__ . '/../inc/bootstrap.php';
requireAuth();

$current_password = request()->get('current_password');
$new_password = request()->get('password');
$confirm_password = request()->get('confirm_password');

//Matches confirmed and new password - works
if ($new_password != $confirm_password) {
    $session->getFlashBag()->add('error', 'New Passwords do NOT match. Please try again.');
    redirect('/account.php');
}

$user = getAuthenticatedUser();

if (empty($user)) {
    $session->getFlashBag()->add('error', 'Something Went Wrong. Please Try Again. If it continues, please log out and back in.');
    redirect('/account.php');
}

if (!password_verify($current_password, $user['password'])) {
    $session->getFlashBag()->add('error', 'Current password is incorrect. Please Try Again');
    redirect('/account.php');
}

$hashed = password_hash($new_password, PASSWORD_DEFAULT);

if (!updatePassword($hashed, $user['id'])) {
    $session->getFlashBag()->add('error', 'Could NOT update password, please try again.');
    redirect('/account.php');
}

$session->getFlashBag()->add('success', 'Password Updated!');
redirect('/account.php');
