<?php
	require_once 'requires.php';

	if ( $auth->isLoggedIn() == false ) {
		header('location: login.php');
		exit;
	}

	$pageTitle = 'Profile';

?>
	<?php require_once 'includes/head.php'; ?>
	<?php require_once 'includes/navbar.php'; ?>

	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<h2>Hi <?= $auth->getUser()->getFullname() ?></h2>
				<img src="data/avatars/<?= $auth->getUser()->getimage() ?>" alt="">
				<a href="#" class="btn btn-info"><?= $auth->getUser()->getFullname()?></a>
			</div>
		</div>
	</div>

<?php require_once 'includes/footer.php'; ?>
