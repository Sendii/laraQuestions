<h4>{{ $questions->id }}</h4>
<h4>Dari : {{ $questions->Question->from->name }}, <i> {{ $questions->Question->privacy }} </i></h4>
<h4>Pertanyaan : {{ $questions->Question->questions }}</h4>
<h4>Jawaban : {{ $questions->answer }}</h4>
