<?php
	require_once 'register-controller.php';

	if ( !isLogged() ) {
		header('location: login.php');
		exit;
	}

	$pageTitle = 'Profile';
	require_once 'includes/head.php';

	$theUser = $_SESSION['user'];
?>
	<?php require_once 'includes/navbar.php'; ?>

	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<h2>Hi <?= $theUser['name'] ?></h2>
				<img src="data/avatars/<?= $theUser['avatar'] ?>" alt="">
				<a href="#" class="btn btn-info"><?= $theUser['email'] ?></a>
			</div>
		</div>
	</div>

<?php require_once 'includes/footer.php'; ?>
