<?php require_once 'app/views/templates/headerPublic.php'?>
<main role="main" class="container">
    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-12">
                <h1>You are not logged in</h1>
            </div>
        </div>
    </div>

<div class="row">
    <div class="col-sm-auto">
		<form action="/login/verify" method="post" >
		<fieldset>
			<div class="form-group">
				<label for="username">Username</label>
				<input required type="text" class="form-control" name="username">
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input required type="password" class="form-control" name="password">
				<?php
				 	 if (isset($_SESSION['failedAuth']) && $_SESSION['failedAuth'] < 3) {
						 echo '<br><div class="alert alert-danger"> Invalid username or password. Please try again.</div>';}
					else if (isset($_SESSION['failedAuth']) && $_SESSION['failedAuth'] >= 3) {
						echo '<br><div class="alert alert-danger"> Too many invalid login attempts. Please try again later.</div>';};
				?>
			</div>
            <br>
		    <button type="submit" class="btn btn-primary">Login</button>
				<a href="/create">
						<button type="button" class="btn btn-secondary">Sign Up</button>
				</a>
		</fieldset>
		</form> 
	</div>
</div>
    <?php require_once 'app/views/templates/footer.php' ?>
