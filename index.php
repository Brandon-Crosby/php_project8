<?php
require_once 'inc/bootstrap.php';

$pageTitle = "Time Tracker";
$page = null;
//var_dump(
  //decodeAuthCookie('auth_user_id')

//);

include 'inc/header.php';
?>
    <div class="col-container actions-container">

      <h1>Welcome</h1>
      <p class="actions-copy">What would you like to do today?</p>
      <div class="actions-wrapper">
        <?php if (isAuthenticated()) : ?>
        <ul class="actions">
            <li class="actions-item">
                <a class="actions-link" href="task_list.php">
              <span class="actions-icon">
                <svg viewbox="0 0 64 64"><use xlink:href="#report_icon"></use></svg>
              </span>
                    View Tasks
                </a>
            </li>
          <li class="actions-item">
            <a class="actions-link" href="task.php">
              <span class="actions-icon">
                <svg viewbox="0 0 64 64"><use xlink:href="#task_icon"></use></svg>
              </span>
              Add Task
            </a>
          </li>
          <?php else: ?>
          <ul class="actions">
          <li class="actions-item">
            <a class="actions-link" href="register.php">
              <span class="actions-icon">
                <svg viewbox="0 0 64 64"><use xlink:href="#user_icon"></use></svg>
              </span>
                Register
              </a>
            </li>
            <ul class="actions">
            <li class="actions-item">
              <a class="actions-link" href="login.php">
                <span class="actions-icon">
                  <svg viewbox="0 0 64 64"><use xlink:href="#report_icon"></use></svg>
                </span>
                  Login
                </a>
              </li>
		</div>

<?php
 endif;
include("inc/footer.php"); ?>
