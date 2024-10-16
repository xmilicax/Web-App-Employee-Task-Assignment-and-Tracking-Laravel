@extends('dashboard')

@section('title')
    <title>Rukovodilac - Zadatak detaljnije</title>
@endsection

@section('naslov_stranice')
    <h1>Lista zadataka</h1>
@endsection

@section('content')
    <div class="zadatak">
        <h2 id="naslov_zadatka">{{ $task->title }}</h2>

        <p>
            <span>Opis: </span>
        <div class="linija"></div>
        <span>{{ $task->description }}</span>
        </p>
        <p>
            <span>Lista izvršioca: </span>
        <div class="linija"></div>
        <span>{{ \App\Models\User::returnNameList($task->list_executors) }}</span>
        </p>
        <p>
            <span>Rukovodilac: </span>
        <div class="linija"></div>
        <span>{{ \App\Models\User::returnName($task->manager)}}</span>
        </p>
        <p>
            <span>Rok izvršenja: </span>
        <div class="linija"></div>
        <span>{{ $task->deadline }}</span>
        </p>
        <p>
            <span>Prioritet: </span>
        <div class="linija"></div>
        <span>{{ $task->priority }}</span>
        </p>
        <p>
            <span>Grupa zadataka: </span>
        <div class="linija"></div>
        <span>{{ \App\Models\TaskGroup::returnGroupName($task->task_group_id)}}</span>
        </p>
        <p>
            <span>Status: </span>
        <div class="linija"></div>
        <span>{{ $task->status }}</span>
        </p>

        <p>
            <span>Fajl: </span>
            <div class="linija"></div>
            <a href="{{ route('file.download', ['file' => $task->file]) }}">Download File</a>
        </p>

    </div>

    <div class="komentari">
        <h2>Komentari</h2>
        <div class="divider"></div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('comments.add.admin') }}" class="commentForm clear">
            @csrf
            <input type="hidden" name="task_id" value="{{ $task->id }}">
            <textarea name="comment" placeholder="Unesite komentar..." required></textarea>
            <button type="submit" class="button3">Dodaj komentar</button>
        </form>

        @foreach ($task->comments as $comment)
            <div class="komentar">
                <p id="korisnik">{{ \App\Models\User::returnName($comment->user_id)}}</p>
                <p id="datum">{{ $comment->created_at->format('Y.m.d. H:i') }}</p>
                <p id="komentar">{{ $comment->content }}</p>
                <form method="POST" action="{{ route('comments.delete.admin', ['comment' => $comment->id]) }}" class="clear">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="brisi" onclick="return confirm('Da li ste sigurni da želite da obrišete ovaj komentar?')">Obriši</button>
                </form>
                <div class="divider"></div>
            </div>
        @endforeach
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.querySelector('.commentForm');

            form.addEventListener('submit', function (event) {
                event.preventDefault();

                const formData = new FormData(form);

                fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': formData.get('_token'),
                    },
                    body: formData,
                })
                    .then(data => {
                        form.querySelector('textarea[name="comment"]').value = '';
                        location.reload();
                    })
                    .catch(error => {
                        console.error('Greška: ', error);
                    });
            });
        });
        const deleteForms = document.querySelectorAll('.clear');
        deleteForms.forEach(form => {
            form.addEventListener('submit', function (event) {
                if (form.querySelector('button.brisi')) {
                    event.preventDefault();

                    if (!confirm('Da li ste sigurni da želite da obrišete ovaj komentar?')) {
                        return;
                    }

                    const formData = new FormData(form);
                    const action = form.action;

                    fetch(action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': formData.get('_token'),
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: formData
                    })
                        .then(data => {
                            window.location.reload();
                        })
                        .catch(error => {
                            console.error('Greška: ', error);
                        });
                }
            });
        });
    </script>
@endsection
