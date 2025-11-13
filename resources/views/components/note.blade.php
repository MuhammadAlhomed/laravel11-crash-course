@props([
    'note'
])

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
                    <span class="fs-6">Posted {{ $note->created_at->DiffForHumans() }}</span> by
                    @if($note?->user)
                    <a href="{{ route('profile.show', $note->user_id) }}">{{ $note->user->username }}</a>
                    @else
                    anonymous
                    @endif
                </p>
            </div>
            <div class="col">
                <div class="col d-flex justify-content-end gap-1">
                    <a href={{route('note.show', $note)}} class="btn btn-primary d-inline-flex align-items-center"><i data-feather="eye" class="align-middle me-2"></i>View</a>

                    @if(auth()->user()?->id === $note->user_id)
                    <a href={{route('note.edit', $note)}} class="btn btn-secondary d-inline-flex align-items-center"><i data-feather="edit" class="align-middle me-2"></i>Edit</a>
                    <form action="{{route('note.destroy', $note)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button href={{route('note.destroy', $note)}} class="btn btn-danger d-inline-flex align-items-center"><i data-feather="trash-2" class="align-middle me-2"></i>Delete</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
