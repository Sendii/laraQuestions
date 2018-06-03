<?php $__currentLoopData = $question_codes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question_code): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<h3><?php echo e($question_code->questions); ?></h3>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>