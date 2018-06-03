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
	$to = basename($_SERVER['REQUEST_URI']);
	$_to = \App\User::where('name', '=', $to)->value('id');
		// dd($_requestUrl);
	?>
	@if($name == $_requestUrl)
	<button type="button" style="margin-left: 20px;" class="btn btn-primary" data-toggle="modal" data-target="#modal-addQuestion">
		Lihat Pertanyaan
	</button>
	@else
	<button type="button" style="margin-left: 20px; margin-bottom: 5px;" class="btn btn-primary" data-toggle="modal" data-target="#modal-addQuestion">
		Tambah Pertanyaan
	</button>
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
									</div>
									<input type="hidden" name="_token" value="{{csrf_token()}}">
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Back</button>
									<button type="submit" class="btn btn-success pull-right">Send!</button>
								</div>
							</form>
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
						<div class="panel-heading"><a href="{{url('account', [$_requestUrl, $question->questions_code])}}">{{ $question->questions_code }}</a></div>

						<div class="panel-body">
							{{ csrf_field() }}
							<div class="form-group">
								<div class="col-md-8">
									<p style="font-size: 20px;">{{ $question->questions }}</p>
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
</body>
</html>