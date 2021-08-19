<div class="container-fluid main" style="height:100vh;padding-left:0px;">

	<div class="d-block d-md-none menu">
		<div class="bar"></div>
	</div>

	<div class="row align-items-center">
		<div class="col-md-9">
			<div class="container content clear-fix">
				<h2 class="mt-5 mb-5">Profile Settings</h2>

				<div class="row" style="height:100%">
					<div class="col-md-3">
						<div href=# class="d-inline"><img src="https://image.flaticon.com/icons/svg/236/236831.svg" width=130px style="margin:0;"><br>
							<p class="pl-2 mt-2"><a href="#" class="btn" style="color:#8f9096;font-weight:600">Edit Picture</a></p>
						</div>
					</div>

					<div class="col-md-9">
						<div class="container">
							<form action="" method="POST">
								<input type="hidden" name="_method" value="put">
								<div class="form-group">
									<label for=fullName>Full Name</label>
									<input name="name" type="text" class="form-control" id="fullName" placeholder="<?php echo $user['name'] ?>">
								</div>

								<div class="form-group">
									<label for=userName>User Name</label>
									<input name="username" type="text" class="form-control" id="userName" placeholder="<?php echo $user['username'] ?>">
								</div>

								<div class="form-group">
									<label for=email>Email</label>
									<input name="email" type="email" class="form-control" id="email" placeholder="<?php echo $user['email'] ?>">
								</div>

								<div class="form-group">
									<label for=pass>New Password</label>
									<input name="password" type="password" class="form-control" id="pass">
								</div>

								<div class="row mt-5">
									<div class="col">
										<button type="submit" class="btn btn-primary btn-block">Save Changes</button>
									</div>

									<div class="col">
										<button type="button" class="btn btn-default btn-block">Cancel</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>