<x-layout>
    <div class="card bg-white">
        <div class="card-body">
            <h1>Note: {{$note->created_at}}</h1>
            <form action="{{route('note.update', $note)}}" id="noteForm" method="post">
                @csrf
                @method('PUT')

                <label for="content">Note text</label>
                <div id="editor">
                    {!! $note->content !!}
                </div>

                <div class="d-flex justify-content-end gap-1 mt-2">
                    <a href="{{route('note.index')}}" class="btn btn-secondary d-inline-flex align-items-center"><i data-feather="arrow-left" class="align-middle me-2"></i>Cancel</a>
                    <button type="submit" class="btn btn-primary d-inline-flex align-items-center"><i data-feather="edit-2" class="align-middle me-2"></i>Edit</button>
                </div>
            </form>
            <script>
                form = document.querySelector('#noteForm');
                form.addEventListener('submit', (event) => {
                    editorContent = document.querySelector('#editor .ql-editor');

                    node = document.createElement('input');

                    node.setAttribute('type', 'hidden');
                    node.setAttribute('name', 'content');
                    node.setAttribute('value', editorContent.innerHTML);

                    form.appendChild(node);
                })
            </script>
        </div>
    </div>
</x-layout>
