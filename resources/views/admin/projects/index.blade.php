@extends('layouts.app')

@section('content')
    <h1>Elenco Progetti</h1>

    @if (session('deleted'))
        <div class="alert alert-success" role="alert">
            {{session('deleted')}}
        </div>
    @endif

    <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Client_Name</th>
            <th scope="col">Tech</th>
            <th scope="col">Summary</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
            <tr>
                <td>{{$project->id}}</td>
                <td>{{$project->name}}</td>
                <td>{{$project->client_name}} <span class="badge rounded-pill text-bg-secondary">{{$project->category?->name}}</span></td>
                <td>
                    @forelse ($project->technologies as $technology)
                        <span class="badge rounded-pill text-bg-primary">{{$technology->name}}</span>
                    @empty
                        <span class="badge rounded-pill text-bg-dark">No Tech</span>
                    @endforelse
                </td>
                <td>{{$project->summary}}</td>
                <td>
                    <a class="btn btn-outline-success" href="{{route('admin.projects.show', $project)}}"><i class="fa-regular fa-eye"></i></a>
                    <a class="btn btn-outline-warning" href="{{route('admin.projects.edit', $project)}}"><i class="fa-regular fa-pen-to-square"></i></a>
                    @include('admin.partials.form-delete')
                </td>
            </tr>
            @endforeach
        </tbody>
      </table>
      <div>
        {{ $projects->links() }}
      </div>
@endsection
