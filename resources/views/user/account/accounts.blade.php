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
	@if($name != $_requestUrl)
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
						<div class="panel-heading"><a href="{{url('account', [ $question->questions_code])}}">{{ $question->questions_code }}</a></div>

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
			<div class="row">
				<div class="col-md-6">
					<!-- Custom Tabs (Pulled to the right) -->
					<div class="nav-tabs-custom">
						<ul class="nav nav-tabs pull-right">
							<li class=""><a href="#tab_1-1" data-toggle="tab" aria-expanded="false">Tab 1</a></li>
							<li class="active"><a href="#tab_2-2" data-toggle="tab" aria-expanded="true">Tab 2</a></li>
							<li class=""><a href="#tab_3-2" data-toggle="tab" aria-expanded="false">Tab 3</a></li>
							<li class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#">
									Dropdown <span class="caret"></span>
								</a>
								<ul class="dropdown-menu">
									<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
									<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
									<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
									<li role="presentation" class="divider"></li>
									<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>
								</ul>
							</li>
							<li class="pull-left header"><i class="fa fa-th"></i> Custom Tabs</li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane" id="tab_1-1">
								<b>How to use:</b>

								<p>Exactly like the original bootstrap tabs except you should use
									the custom wrapper <code>.nav-tabs-custom</code> to achieve this style.</p>
									A wonderful serenity has taken possession of my entire soul,
									like these sweet mornings of spring which I enjoy with my whole heart.
									I am alone, and feel the charm of existence in this spot,
									which was created for the bliss of souls like mine. I am so happy,
									my dear friend, so absorbed in the exquisite sense of mere tranquil existence,
									that I neglect my talents. I should be incapable of drawing a single stroke
									at the present moment; and yet I feel that I never was a greater artist than now.
								</div>
								<!-- /.tab-pane -->
								<div class="tab-pane active" id="tab_2-2">
									The European languages are members of the same family. Their separate existence is a myth.
									For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ
									in their grammar, their pronunciation and their most common words. Everyone realizes why a
									new common language would be desirable: one could refuse to pay expensive translators. To
									achieve this, it would be necessary to have uniform grammar, pronunciation and more common
									words. If several languages coalesce, the grammar of the resulting language is more simple
									and regular than that of the individual languages.
								</div>
								<!-- /.tab-pane -->
								<div class="tab-pane" id="tab_3-2">
									Lorem Ipsum is simply dummy text of the printing and typesetting industry.
									Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
									when an unknown printer took a galley of type and scrambled it to make a type specimen book.
									It has survived not only five centuries, but also the leap into electronic typesetting,
									remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
									sheets containing Lorem Ipsum passages, and more recently with desktop publishing software
									like Aldus PageMaker including versions of Lorem Ipsum.
								</div>
								<!-- /.tab-pane -->
							</div>
							<!-- /.tab-content -->
						</div>
						<!-- nav-tabs-custom -->
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