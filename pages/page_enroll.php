<div class="containter p-5">

	<?php if(isset($_SESSION['enroll']['status']) && $_SESSION['enroll']['status'] == 'success') { echo '<div class="alert alert-primary" role="alert">User enrolled, you can join our courses now.</div>'; } ?>

	<h1>Enroll a new student</h1>

	<?php if(isset($_SESSION['enroll']['status']) && $_SESSION['enroll']['status'] == 'error') { 
		$showErrors = '<div class="text-danger"><h6>Please fix the errors below:</h6><ul>';
		foreach($_SESSION['enroll']['errors'] as $error){
			$showErrors .= '<li>'.$error.'</li>';
		}
		$showErrors .= '</ul></div>';
		echo $showErrors;
	}	?>
	<form action = "process.php" method = "post">
		<div class="form-group">
			<label for="name">Name</label>
			<input type="text" id="name" class="form-control" name="name" placeholder="Enter Full name" required value="<?= isset($_SESSION['enroll']['data']) ? $_SESSION['enroll']['data']['name'] : ''; ?>">
		</div>
		<div class="form-group">
			<label for="email">Email address</label>
			<input type="email" id="email" class="form-control" name="email" placeholder="Enter Email" required value="<?= isset($_SESSION['enroll']['data']) ? $_SESSION['enroll']['data']['email'] : "";?>" >
		</div>
		<div class="form-group">
			<label for="phone">Mobile</label>
			<input type="text" id="phone" class="form-control" name="phone" placeholder="Enter Mobile Number" required value="<?= isset($_SESSION['enroll']['data']) ? $_SESSION['enroll']['data']['phone'] : "";?>" >
		</div>
		<input type="submit" name="enroll" class="btn btn-primary" value="Enroll">
	</form>
</div>
<?php unset($_SESSION['enroll']); ?>