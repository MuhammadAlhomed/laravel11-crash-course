<x-layout>
    <a href={{route('note.index')}} class="btn btn-primary d-inline-flex align-items-center"><i data-feather="arrow-left" class="align-middle me-2"></i>Back</a>
    <div class="card bg-white my-2">
        <div class="card-body">
            <h1>Note: {{$note->created_at}}</h1>
            <p class="card-text">
                {!! $note->content !!}
            </p>

            @if(auth()->user()?->id === $note->user_id)
            <div class="d-flex justify-content-end gap-1">
                <a href={{route('note.edit', $note)}} class="btn btn-secondary d-inline-flex align-items-center"><i data-feather="edit" class="align-middle me-2"></i>Edit</a>
                <form action="{{route('note.destroy', $note)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button href={{route('note.destroy', $note)}} class="btn btn-danger d-inline-flex align-items-center"><i data-feather="trash-2" class="align-middle me-2"></i>Delete</button>
                </form>
            </div>
            @endif
        </div>
    </div>
</x-layout>
