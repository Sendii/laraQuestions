<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</head>
<body>
	
	<?php 
	$_requestUrl = basename($_SERVER['REQUEST_URI']);
	$account = "account/".$_requestUrl;
	$name = Auth::user()->name;
	$from = Auth::user()->id;
	$status = \App\User::whereName($_requestUrl)->value('status') == "Blocked";
	$admin = Auth::user()->akses == "Admin";
	$to = basename($_SERVER['REQUEST_URI']);
	$_to = \App\User::where('name', '=', $to)->value('id');
		// dd($_requestUrl);
	?>
	<?php if($name != $_requestUrl): ?>
	<button type="button" style="margin-left: 20px; margin-bottom: 5px;" class="btn btn-primary" data-toggle="modal" data-target="#modal-addQuestion">
		Nanya ahh!
	</button>
	<?php endif; ?>
	<?php if($admin && !$status): ?>
	<a style="margin-left: 20px; margin-bottom: 5px;" class="btn btn-primary" href="<?php echo e(url('admin/banned', $_requestUrl)); ?>">
		Banned User
	</a>
	<?php elseif($status): ?>
	<a style="margin-left: 20px; margin-bottom: 5px;" class="btn btn-primary" href="#">
		User ter-Banned.
	</a>
	<?php endif; ?>
	<div class="container">
		<div class="row">	
			<!-- MODAL -->
			<div class="modal fade in" id="modal-addQuestion">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span></button>
								<h4 class="modal-title">Add Question</h4>
							</div>
							<div class="modal-body">
								<form method="POST" action="<?php echo e(url('question/save')); ?>">
									<div class="form-group">
										<label>Question</label>
										<input type="hidden" name="useridto" value="<?php echo e($_to); ?>">
										<input type="hidden" name="useridfrom" value="<?php echo e($from); ?>">
										<input type="text" 
										class="form-control" name="question" required="Please insert" placeholder="Question.." oninvalid="this.setCustomValidity('Please insert a Question')"
										oninput="setCustomValidity('')">
										<br>
										<select class="form-control" name="privacy" required>
											<option value="">Privasi</option>
											<option value="Public">Public</option>
											<option value="Private">Private</option>
										</select>
									</div>
									<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
									<div class="modal-footer">
										<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Back</button>
										<button type="submit" class="btn btn-success pull-right">Send!</button>
									</div>
								</form>
							</div> 
						</div>
					</div>
				</div>
				<div class="modal fade in" id="modal-answerQuestion">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">×</span></button>
									<h4 class="modal-title">Answer Question</h4>
								</div>
								<div class="modal-body">
									<form method="POST" action="<?php echo e(url('answer/save')); ?>">
										<div class="form-group">
											<label>Question</label>
											<input type="hidden" name="questions_code" id="questions_code">
											<input type="text" 
											class="form-control" id="questions" name="question" required="Please insert" readonly>
											<br>
											<input type="text" 
											class="form-control" name="answer" placeholder="Answer...">
										</div>
										<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
										<div class="modal-footer">
											<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Back</button>
											<button type="submit" class="btn btn-success pull-right">Send!</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- END MODAL -->

				<!-- questions div -->
				<?php $__currentLoopData = $questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php 
				$nameaccount = \App\User::where('id', $question->user_id_to)->value('name');
				?>
				<?php if($_requestUrl == $nameaccount): ?>
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						<div class="panel panel-default">
							<div class="panel-heading">
								<a target="_blank" href="<?php echo e(url($_requestUrl, [ $question->questions_code])); ?>"><?php echo e($question->questions_code); ?></a>
								<?php if($to == $name): ?>
								<a style="margin-top: -7px;" class="btn btn-primary pull-right" data-toggle="modal" data-question="<?php echo e($question->questions); ?>" data-question_code="<?php echo e($question->questions_code); ?>" data-target="#modal-answerQuestion">Jawaabbb!</a>
								<?php endif; ?>
							</div>

							<div class="panel-body">
								<?php echo e(csrf_field()); ?>

								<div class="form-group">
									<div class="col-md-8">
										<a href="<?php echo e(url('answers', [$question->id, $question->questions_code])); ?>">
											<p style="font-size: 20px;"><?php echo e($question->questions); ?></p>
										</a>
										<?php if($to == $name): ?>
										<div style="margin-left: 650px;">
											<?php if($question->privacy == "Private"): ?>
											<h6>Private</h6>
											<?php elseif($question->privacy == "Public"): ?>
											<h6>Public</h6>
											<?php endif; ?>
										</div>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php endif; ?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<!-- endquestions div -->
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$('#modal-answerQuestion').on('show.bs.modal', function(event) {
			console.log('Modal opened');

			var button = $(event.relatedTarget)
			var questions = button.data('question')
			var questions_code = button.data('question_code')

			var modal = $(this)
			modal.find('.modal-body .form-group #questions').val(questions);
			modal.find('.modal-body .form-group #questions_code').val(questions_code);
		});
	</script>
</body>
</html>