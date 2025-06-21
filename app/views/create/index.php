<?php require_once 'app/views/templates/headerPublic.php'?>
<main role="main" class="container">
    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-12">
                <h1>Create an account</h1>
            </div>
        </div>
    </div>

<div class="row">
    <div class="col-sm-auto">
    <form action="/create/register" method="post" >
    <fieldset>
      <div class="form-group">
        <label for="username">Username</label>
        <input required type="text" class="form-control" name="username">
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input required type="password" class="form-control" name="password">
          <?php
               if (isset($_SESSION['usernameExists']) == 1) {
                   echo '<br><div class="alert alert-danger"> Username already exists. Please enter a different username.</div>';}
          else if (isset($_SESSION['passwordError']) == 1) {
                echo '<br><div class="alert alert-danger"> Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, and one number.</div>';
          }
          ?>
      </div>
            <br>
        <button type="submit" class="btn btn-primary">Sign Up</button>
    </fieldset>
    </form> 
  </div>
</div>
    <?php require_once 'app/views/templates/footer.php' ?>