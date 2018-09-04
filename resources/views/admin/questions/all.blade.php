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
		@foreach($questions as $question)
			<tr>
				<td>{{ $question->id }}</td>
				<td>{{ $question->from->name }}</td>
				<td>{{ $question->to->name }}</td>
				<td>{{ $question->questions }}</td>
				<td>{{ $question->questions_code }}</td>
				<td>{{ $question->created_at }}</td>
			</tr>
		@endforeach
	</tbody>
</table>
</body>
</html>