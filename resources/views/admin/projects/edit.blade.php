@extends('layouts.app')

@section('content')
    <form action="{{route('admin.projects.update', $project)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{old('name', $project->name)}}" placeholder="name..">
        </div>
        <div class="mb-3">
            <label for="client_name" class="form-label">client_name</label>
            <input type="text" class="form-control" id="client_name" name="client_name" value="{{old('client_name', $project->client_name)}}" placeholder="client_name..">
        </div>
        <div class="mb-3">
            <label for="technologies" class="form-label d-block">technologies</label>
                @foreach ($technologies as $technology)
                    <input type="checkbox" id="technology{{$loop->iteration}}" name="technologies[]" value="{{$technology->id}}"
                    @if (!$errors->all() && $project->technologies->contains($technology))
                        checked
                    @elseif ($errors->all() && in_array($technology->id, old('technologies',[])))
                        checked
                    @endif
                    >
                    <label class="me-2" for="technology{{$loop->iteration}}">{{$technology->name}}</label>
                @endforeach
        </div>
        <div class="mb-3">
            <label for="summary" class="form-label">summary</label>
            <input type="text" class="form-control" id="summary" name="summary" value="{{old('summary', $project->summary)}}" placeholder="summary..">
        </div>
        <div class="mb-3">
            <label for="cover_image" class="form-label">cover_image</label>
            <input onchange="showImage(event)" type="file" class="form-control" id="cover_image" name="cover_image" value="{{old('cover_image', $project->cover_image)}}" placeholder="cover_image..">
            <div>
                <img width="300" id="image_thumb_edit" src=" {{asset('storage/' . $project['image']) }} " alt="">
            </div>
        </div>
        <button type="submit" class="btn btn-outline-success">Invia</button>
    </form>
    <script>
        function showImage(event) {
            const tagImage = document.getElementById('image_thumb_edit');
            tagImage.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
@endsection
