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
    <form action="/login/verify" method="post" >
    <fieldset>
            <br>
            <div class="alert alert-danger"> You have 3 consecutive invalid login attempts. Please try again after </div>
        <button type="submit" class="btn btn-primary">Back to Login page</button>
    </fieldset>
    </form> 
  </div>
</div>
    <?php require_once 'app/views/templates/footer.php' ?>
