<x-layout>
    <a href={{route('note.create')}} class="btn btn-primary d-inline-flex align-items-center"><i data-feather="plus" class="align-middle me-2"></i>New Note</a>

    <div id="notesFeed" class="my-3">
    @foreach ($notes as $note)
        <div class="my-3">
            <x-note :note="$note"/>
        </div>
    @endforeach
    </div>

    {{ $notes->links()}}
</x-layout>
