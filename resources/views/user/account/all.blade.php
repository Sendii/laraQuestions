<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href=" {{ asset('css/bootstrap.css') }} ">
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
			@foreach($accounts as $account)
			<div class="card" style="width: 18rem; float: left; margin-bottom: 4px; margin-left: 5px;">
				<img class="img-thumbnail" src="{{ asset('img/'.$account->imageprofile) }}" alt="Card">
				<div class="card-body">
					<h5 class="card-title">{{ $account->name }}</h5>
					<p class="card-text">{{ $account->email }}.</p>
					<a href="{{url('account', [$account->name])}}" class="btn btn-primary">{{ $account->name }}</a>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</body>
</html>