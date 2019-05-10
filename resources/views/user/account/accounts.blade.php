<!DOCTYPE html>
<html>
<head>
	<title></title>
	@include('layouts.app')
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
	@if($name != $_requestUrl)
	<button type="button" style="margin-left: 20px; margin-bottom: 5px;" class="btn btn-primary" data-toggle="modal" data-target="#modal-addQuestion">
		Nanya ahh!
	</button>
	@endif
	@if($admin && !$status)
	<a style="margin-left: 20px; margin-bottom: 5px;" class="btn btn-primary" href="{{url('admin/banned', $_requestUrl)}}">
		Banned User
	</a>
	@elseif($status)
	<a style="margin-left: 20px; margin-bottom: 5px;" class="btn btn-primary" href="#">
		User ter-Banned.
	</a>
	@endif
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
								<form method="POST" action="{{url('question/save')}}">
									<div class="form-group">
										<label>Question</label>
										<input type="hidden" name="useridto" value="{{$_to}}">
										<input type="hidden" name="useridfrom" value="{{$from}}">
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
									<input type="hidden" name="_token" value="{{csrf_token()}}">
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
									<form method="POST" action="{{url('answer/save')}}">
										<div class="form-group">
											<label>Question</label>
											<input type="hidden" name="questions_code" id="questions_code">
											<input type="text" 
											class="form-control" id="questions" name="question" required="Please insert" readonly>
											<br>
											<input type="text" 
											class="form-control" name="answer" placeholder="Answer...">
										</div>
										<input type="hidden" name="_token" value="{{csrf_token()}}">
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
				@foreach($questions as $question)
				<?php 
				$nameaccount = \App\User::where('id', $question->user_id_to)->value('name');
				?>
				@if($_requestUrl == $nameaccount)
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						<div class="panel panel-default">
							<div class="panel-heading">
								<a target="_blank" href="{{url($_requestUrl, [ $question->questions_code])}}">{{ $question->questions_code }}</a>
								@if($to == $name)
								<a style="margin-top: -7px;" class="btn btn-primary pull-right" data-toggle="modal" data-question="{{ $question->questions }}" data-question_code="{{ $question->questions_code }}" data-target="#modal-answerQuestion">Jawaabbb!</a>
								@endif
							</div>

							<div class="panel-body">
								{{ csrf_field() }}
								<div class="form-group">
									<div class="col-md-8">
										<a href="{{url('answers', [$question->id, $question->questions_code])}}">
											<p style="font-size: 20px;">{{ $question->questions }}</p>
										</a>
										@if($to == $name)
										<div style="margin-left: 650px;">
											@if($question->privacy == "Private")
											<h6>Private</h6>
											@elseif($question->privacy == "Public")
											<h6>Public</h6>
											@endif
										</div>
										@endif
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				@endif
				@endforeach
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