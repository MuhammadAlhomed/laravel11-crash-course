<x-layout>
    <a href={{route('note.create')}} class="btn btn-primary">New Note</a>
    <div class="my-2">
    @foreach ($notes as $note)
        <div class="my-1">
            <a href="{{route('note.show', $note)}}"></a>
            <div class="card">
                <div class="card-body">
                    <p class="card-text">
                        {{ Str::words($note->content, 100) }}
                    </p>
                    <div class="d-flex justify-content-end gap-1">
                        <a href={{route('note.show', $note)}} class="btn btn-primary">View</a>
                        <a href={{route('note.edit', $note)}} class="btn btn-secondary">Edit</a>
                        <form action="{{route('note.destroy', $note)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button href={{route('note.destroy', $note)}} class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    </div>

    {{ $notes->links()}}
</x-layout>
