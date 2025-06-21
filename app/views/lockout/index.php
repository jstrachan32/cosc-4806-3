<?php require_once 'app/views/templates/headerPublic.php'?>
<main role="main" class="container">
    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-12">
                <h1>Too many invalid login attempts</h1>
            </div>
        </div>
    </div>

<div class="row">
    <div class="col-sm-auto">
    <form action="/lockout/verify" method="post" >
    <fieldset>
            <br>
            <?php
            echo '<div class="alert alert-danger"> You have exceeded the maximum number of login attempts. Please try again in 60 seconds. You will be able to login after ' . $_SESSION['lockout_time'] . '</div>'
            ?>
        <button type="submit" class="btn btn-primary">Back to Login page</button>
    </fieldset>
    </form> 
  </div>
</div>
    <?php require_once 'app/views/templates/footer.php' ?>
