<?php $__currentLoopData = $nameaccounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nameaccount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<h4> <?php echo e($nameaccount->name); ?> </h4>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>