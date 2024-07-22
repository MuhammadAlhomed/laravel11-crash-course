<x-layout>
    <div class="card">
        <div class="card-body">
            <h1>Note: {{$note->created_at}}</h1>
            <p class="card-text">
                {{ $note->content }}
            </p>
            <div class="d-flex justify-content-end gap-1">
                <a href={{route('note.edit', $note)}} class="btn btn-secondary">Edit</a>
                <a href={{route('note.destroy', $note)}} class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
</x-layout>
