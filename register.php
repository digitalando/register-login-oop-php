<?php
	// llamamos a las funciones controladoras
	require_once 'requires.php';
	require_once 'register-controller.php';

	if ( isLogged() ) {
		header('location: profile.php');
		exit;
	}

	$countries = [
		'ar' => 'Argentina',
		'bo' => 'Bolivia',
		'br' => 'Brasil',
		'co' => 'Colombia',
		'cl' => 'Chile',
		'ec' => 'Ecuador',
		'pa' => 'Paraguay',
		'pe' => 'Perú',
		'uy' => 'Uruguay',
		've' => 'Venezuela',
	];

	$form = new UserRegisterForm($_POST, $_FILES);
	if ($_POST) {
		if ($form->isValid()) {
			$imageName = saveImage($_FILES['userAvatar']);

			$_POST['avatar'] = $imageName;

			$user = saveUser($_POST);

			logIn($user);
		}
	}

	$pageTitle = 'Register';
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
				<h2>Formulario de registro</h2>

				<form method="post" enctype="multipart/form-data">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label><b>Nombre completo:</b></label>
								<input
									type="text"
									name="userFullName"
									class="form-control <?= $form->fieldHasError('fullName') ? 'is-invalid' : ''; ?>"
									value="<?= $form->getFullName(); ?>"
								>
								<?php if ($form->fieldHasError('fullName')): ?>
									<div class="invalid-feedback">
										<?= $form->getFieldError('fullName') ?>
									</div>
								<?php endif; ?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label><b>Correo electrónico:</b></label>
								<input
									type="text"
									name="userEmail"
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
									name="userPassword"
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
							<div class="form-group">
								<label><b>Repetir Password:</b></label>
								<input
									type="password"
									name="userRePassword"
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
							<div class="form-group">
								<label><b>País de nacimiento:</b></label>
								<select
									name="userCountry"
									class="form-control <?= $form->fieldHasError('country') ? 'is-invalid' : ''; ?>"
								>
									<option value="">Elegí un país</option>
									<?php foreach ($countries as $code => $country): ?>
										<option
											<?= $code == $form->getCountry() ? 'selected' : '' ?>
											value="<?= $code ?>"><?= $country ?></option>
									<?php endforeach; ?>
								</select>
								<?php if ($form->fieldHasError('country')): ?>
									<div class="invalid-feedback">
										<?= $form->getFieldError('country') ?>
									</div>
								<?php endif; ?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label><b>Imagen de perfil:</b></label>
								<div class="custom-file">
									<input
										type="file"
										class="custom-file-input <?= $form->fieldHasError('image') ? 'is-invalid' : ''; ?>"
									 	name="userAvatar"
									>
									<label class="custom-file-label">Choose file...</label>
									<?php if ($form->fieldHasError('image')): ?>
										<div class="invalid-feedback">
											<?= $form->getFieldError('image') ?>
										</div>
									<?php endif; ?>
								</div>
							</div>
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
