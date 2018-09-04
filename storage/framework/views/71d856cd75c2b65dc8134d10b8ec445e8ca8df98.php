<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<table class="table table-hover table-borered">
	<thead>
		<tr>
			<td>No</td>
			<td>Pengirim</td>
			<td>Tujuan</td>
			<td>Pertanyaan</td>
			<td>Kode Pertanyaan</td>
			<td>Tanggal dikirim</td>
		</tr>
	</thead>
	<tbody>
		<?php $__currentLoopData = $questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr>
				<td><?php echo e($question->id); ?></td>
				<td><?php echo e($question->from->name); ?></td>
				<td><?php echo e($question->to->name); ?></td>
				<td><?php echo e($question->questions); ?></td>
				<td><?php echo e($question->questions_code); ?></td>
				<td><?php echo e($question->created_at); ?></td>
			</tr>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</tbody>
</table>
</body>
</html>