@extends('layouts.app')

@section('content')
    <form action="{{route('admin.projects.store')}}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="name..">
        </div>
        <div class="mb-3">
            <label for="client_name" class="form-label">client_name</label>
            <input type="text" class="form-control" id="client_name" name="client_name" placeholder="client_name..">
        </div>
        <div class="mb-3">
            <label for="summary" class="form-label">summary</label>
            <input type="text" class="form-control" id="summary" name="summary" placeholder="summary..">
        </div>
        <div class="mb-3">
            <label for="technologies" class="form-label d-block">technologies</label>
                @foreach ($technologies as $technology)
                    <input type="checkbox" id="technology{{$loop->iteration}}" name="technologies[]" value="{{$technology->id}}"
                    @if (in_array($technology->id, old('technologies',[])))
                        checked
                    @endif
                    >
                    <label class="me-2" for="technology{{$loop->iteration}}">{{$technology->name}}</label>
                @endforeach
        </div>
        <div class="mb-3">
            <label for="cover_image" class="form-label">cover_image</label>
            <input onchange="showImage(event)" type="file" class="form-control" id="cover_image" name="cover_image" placeholder="cover_image..">
            <div>
                <img width="300" id="image_thumb" src="  " alt="">
            </div>
        </div>
        <button type="submit" class="btn btn-outline-success">Invia</button>
    </form>

    <script>
        function showImage(event) {
            const tagImage = document.getElementById('image_thumb');
            tagImage.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
@endsection
