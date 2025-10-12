<x-layout>
    <a href={{route('note.create')}} class="btn btn-primary">New Note</a>
    <div class="my-3">
    @foreach ($notes as $note)
        <div class="my-3">
            <a href="{{route('note.show', $note)}}"></a>
            <div class="card bg-white">
                <div class="card-body">
                    <div class="card-text">
                        {!!  Str::words($note->content, 100) !!}
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex align-items-center">
                        <div class="col">
                            <p class=" m-0 text-secondary">
                                <span class="fs-6">Posted {{ $note->created_at->DiffForHumans() }}</span> by <a href="#">User</a>
                            </p>
                        </div>
                        <div class="col">
                            <div class="col d-flex justify-content-end gap-1">
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
            </div>
        </div>
    @endforeach
    </div>

    {{ $notes->links()}}
</x-layout>
