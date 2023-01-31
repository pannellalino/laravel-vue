<aside>
    <ul>
        <li><a href="{{route('admin.projects.index')}}">Go Table</a></li>
        <li><a href="{{route('admin.projects.create')}}">Create New Project</a></li>
        <li><a href="{{route('admin.categories_project')}}">Links</a></li>
    </ul>
</aside>

<style>
    aside{
        padding-top: 20px;
        background-color: rgb(30, 30, 30);
        height: calc(100vh - 80px);
    }

    ul li a{
        color: white;
        text-decoration: none;
    }
    ul li a:hover{
        color: grey;
    }
    ul li:hover{
        color: grey;
    }
</style>
