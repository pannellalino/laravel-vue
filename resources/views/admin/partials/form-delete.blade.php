<form onsubmit="return confirm('Confermi l\'eliminazione di: {{$project->name}}')" class="d-inline" action="{{route('admin.projects.destroy', $project)}}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-outline-danger"><i class="fa-regular fa-trash-can"></i></button>
</form>
