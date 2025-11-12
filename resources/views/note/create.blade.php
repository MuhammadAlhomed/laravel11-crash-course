<x-layout>
    <div class="card bg-white">
        <div class="card-body">
            <h1>New Note</h1>
            <form action="{{route('note.store')}}" id="noteForm" method="post">
                @csrf

                <label for="content">Note text</label>
                <div id="editor">

                </div>

                <div class="d-flex justify-content-end gap-1 mt-2">
                    <a href="{{route('note.index')}}" class="btn btn-danger d-inline-flex align-items-center"><i data-feather="trash-2" class="align-middle me-2"></i>Cancel</a>
                    <button type="submit" class="btn btn-primary d-inline-flex align-items-center"><i data-feather="plus" class="align-middle me-2"></i>Create</button>
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
