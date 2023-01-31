@extends('layouts.app')

@section('content')
   <div class="container">
    <h1>Elenco Progetti</h1>

    @if (session('deleted'))
        <div class="alert alert-success" role="alert">

            {{session('deleted')}}
        </div>
    @endif

    <table class="table">
        <thead>
          <tr>
            <th scope="col">Category</th>
            <th scope="col">Projects</th>
          </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
            <tr>
                <td>{{$category->name}}</td>
                <td>
                    <ul>
                        @foreach ($category->projects as $project)
                            <li>
                                <a class="text-dark" href="{{route('admin.projects.show', $project)}}">{{$project->name}}</a>
                            </li>
                        @endforeach
                    </ul>
                </td>
            </tr>
            @empty
            <h4>nessun risultato</h4>
            @endforelse
        </tbody>
      </table>
   </div>
@endsection

<style>
    ul li a:hover{
        color: grey;
        text-decoration: underline lightgrey;
    }
</style>

