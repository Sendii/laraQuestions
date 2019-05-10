<h4><?php echo e($questions->id); ?></h4>
<h4>Dari : <?php echo e($questions->Question->from->name); ?>, <i> <?php echo e($questions->Question->privacy); ?> </i></h4>
<h4>Pertanyaan : <?php echo e($questions->Question->questions); ?></h4>
<h4>Jawaban : <?php echo e($questions->answer); ?></h4>
