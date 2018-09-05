<?php
	// llamamos a las funciones controladoras
	require_once 'register-controller.php';

	if ( isLogged() ) {
		header('location: profile.php');
		exit;
	}

	$pageTitle = 'Login';
	require_once 'includes/head.php';

	// Persistencia de datos
	$userEmail = isset($_POST['userEmail']) ? trim($_POST['userEmail']) : '';

	$errors = [];

	if ($_POST) {
		$errors = loginValidate($_POST);

		if ( count($errors) == 0) {
			$user = getUserByEmail($_POST['userEmail']);

			if( isset($_POST['rememberUser']) ) {
				setcookie('userLogged', $_POST['userEmail'], time() + 3600);
			}

			logIn($user);
		}
	}
?>
	<?php require_once 'includes/navbar.php'; ?>

	<!-- Register-Form -->
	<div class="container" style="margin-top:30px; margin-bottom: 30px;">
		<div class="row justify-content-center">
			<div class="col-md-10">
				<?php if ( $errors ): ?>
					<div class="alert alert-danger">
						<ul>
						<?php foreach ($errors as $error): ?>
							<li> <?= $error ?> </li>
						<?php endforeach; ?>
						</ul>
					</div>
				<?php endif; ?>
				<h2>Formulario de Login</h2>

				<form method="post">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label><b>Correo electrónico:</b></label>
								<input
									type="text"
									name="userEmail"
									class="form-control <?= isset($errors['email']) ? 'is-invalid' : ''; ?>"
									value="<?= $userEmail; ?>"
								>
								<?php if (isset($errors['email'])): ?>
									<div class="invalid-feedback">
										<?= $errors['email'] ?>
									</div>
								<?php endif; ?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label><b>Password:</b></label>
								<input
									type="password"
									name="userPassword"
									class="form-control <?= isset($errors['password']) ? 'is-invalid' : ''; ?>"
								>
								<?php if (isset($errors['password'])): ?>
									<div class="invalid-feedback">
										<?= $errors['password'] ?>
									</div>
								<?php endif; ?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-check">
								<label class="form-check-label">
									<input class="form-check-input" type="checkbox" name="rememberUser">
									Recordarme
							  </label>
							</div>
							<br>
						</div>
						<div class="col-12">
							<button type="submit" class="btn btn-primary">Registrarse</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- //Register-Form -->

<?php require_once 'includes/footer.php'; ?>
