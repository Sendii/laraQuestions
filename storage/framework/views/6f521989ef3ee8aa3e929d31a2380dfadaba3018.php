<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href=" <?php echo e(asset('css/bootstrap.css')); ?> ">
	<style type="text/css">
	.card {
		/* Add shadows to create the "card" effect */
		transition: 0.3s;
		border-radius: 5px; /* 5px rounded corners */

	}
</style>
</head>
<body>
	<div class="row">
		<div class="container">
			<?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<div class="card" style="width: 18rem; float: left; margin-bottom: 4px; margin-left: 5px;">
				<img class="img-thumbnail" src="<?php echo e(asset('img/'.$account->imageprofile)); ?>" alt="Card">
				<div class="card-body">
					<h5 class="card-title"><?php echo e($account->name); ?></h5>
					<p class="card-text"><?php echo e($account->email); ?>.</p>
					<a href="<?php echo e(url('account', [$account->name])); ?>" class="btn btn-primary"><?php echo e($account->name); ?></a>
				</div>
			</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>
	</div>
</body>
</html>