<?php
	// llamamos a las funciones controladoras
	// require_once 'register-controller.php';
	
	require_once 'requires.php';

	use AFS\Forms\Form;
	use AFS\Forms\UserLoginForm;

	use AFS\Entities\User;
	use AFS\Entities\Auth;

	use AFS\Repositories\Repository;
	use AFS\Repositories\UserRepository;

	use AFS\Databases\Database;
	use AFS\Databases\JsonDatabase;

	if ( $auth->isLoggedIn() ) {
		header('location: profile.php');
		exit;
	}

	$form = new UserLoginForm($_POST);
	if ($_POST) 
	{
		// Verificamos que el formulario sea válido
		if ($form->isValid()) 
		{
			// Verificamos que el usuario exista en base
			$userRepo = new UserRepository();
			$user = $userRepo->fetchByField('email', $form->getEmail());

			// Verificamos que el password sea correcto
			if ($user && $user->verifyPassword($form->getPassword())) 
			{
				// Logeamos al usuario
				$auth->login($user, $form->getRememberMe());
				header('location: profile.php');
			}
			else
			{
				$form->addError('email', 'El usuario o la contraseña son incorrectos');
			}
		}
	}



	$pageTitle = 'Login';
?>
	<?php require_once 'includes/head.php'; ?>
	<?php require_once 'includes/navbar.php'; ?>

	<!-- Register-Form -->
	<div class="container" style="margin-top:30px; margin-bottom: 30px;">
		<div class="row justify-content-center">
			<div class="col-md-10">
				<?php if ( $_POST && $form->isValid() == false): ?>
					<div class="alert alert-danger">
						<ul>
						<?php foreach ($form->getAllErrors() as $error): ?>
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
									name="email"
									class="form-control <?= $form->fieldHasError('email') ? 'is-invalid' : ''; ?>"
									value="<?= $form->getEmail(); ?>"
								>
								<?php if ($form->fieldHasError('email')): ?>
									<div class="invalid-feedback">
										<?= $form->getFieldError('email') ?>
									</div>
								<?php endif; ?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label><b>Password:</b></label>
								<input
									type="password"
									name="password"
									class="form-control <?= $form->fieldHasError('password') ? 'is-invalid' : ''; ?>"
								>
								<?php if ($form->fieldHasError('password')): ?>
									<div class="invalid-feedback">
										<?= $form->getFieldError('password') ?>
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
