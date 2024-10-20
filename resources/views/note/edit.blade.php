<x-layout>
    <div class="card">
        <div class="card-body">
            <h1>Note: {{$note->created_at}}</h1>
            <form action="{{route('note.update', $note)}}" method="post">
                @csrf
                @method('PUT')

                <label for="content">Note text</label>
                <div id="editor">
                    {!! $note->content !!}
                </div>

                <div class="d-flex justify-content-end gap-1 mt-2">
                    <a href="{{route('note.index')}}" class="btn btn-danger">Cancel</a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
            <script>
                form = document.querySelector('form');
                form.addEventListener('submit', (event) => {
                    editorContent = document.querySelector('#editor .ql-editor');

                    node = document.createElement('input');

                    node.setAttribute('type', 'hidden');
                    node.setAttribute('name', 'content');
                    node.setAttribute('value', editorContent.innerHTML);

                    console.log(node);
                    form.appendChild(node);
                })
            </script>
        </div>
    </div>
</x-layout>
