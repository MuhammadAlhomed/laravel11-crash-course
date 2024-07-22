<x-layout>
    <div class="card">
        <div class="card-body">
            <h1>New Note</h1>
            <form action="{{route('note.store')}}" method="post">
                @csrf

                <label for="content">Note text</label>
                <textarea class="w-100" name="content" id="content" rows="10" placeholder="Write everything you have in mind to share with the world!"></textarea>

                <div class="d-flex justify-content-end gap-1">
                    <a href="{{route('note.index')}}" class="btn btn-danger">Cancel</a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
