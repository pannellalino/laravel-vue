<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Models\Category;
use App\Models\Project;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::paginate(20);
        return view('admin.projects.index', compact('projects'));
    }

    public function categories_project(){
        $categories = Category::all();
        return view('admin.projects.list_categories_project', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $technologies = Technology::all();
        return view('admin.projects.create', compact('technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        $project_data = $request->all();

        if(array_key_exists('cover_image', $project_data)) {
            $project_data['image_original_name'] = $request->file('cover_image')->getClientOriginalName();

            $project_data['cover_image'] = Storage::put('uploads', $project_data['cover_image']);
        }

        $project_data['slug'] = Project::generateSlug($project_data['name']);

        $new_project = new Project();
        $new_project->fill($project_data);
        $new_project->save();

        if(array_key_exists('technolgies',$project_data)){
            $new_project->technolgies()->attach($project_data['technolgies']);
        }

        dd($project_data);
        return redirect()->route('admin.projects.show',$new_project)->with('message','Progetto creato correttamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $technologies = Technology::all();
        return view('admin.projects.edit', compact('project','technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $project_data = $request->all();

        if(array_key_exists('cover_image', $project_data)) {
            if($project->cover_image) {
                Storage::disk('public')->delete($project->cover_image);
            }

            $project_data['image_original_name'] = $request->file('cover_image')->getClientOriginalName();

            $project_data['cover_image'] = Storage::put('uploads', $project_data['cover_image']);
        }


        if($project_data['name'] != $project->name){
            $project_data['slug'] = Project::generateSlug($project_data['name']);
        }else{
            $project_data['slug'] = $project->slug;
        }


        $project->update($project_data);

        if(array_key_exists('technolgies',$project_data)){
            $project->technolgies()->sync($project_data['technolgies']);
        }else{
            $project->technologies()->detach();
        }

        return redirect()->route('admin.projects.show', $project)->with('message','Progetto aggiornato correttamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        if($project->cover_image) {
            Storage::disk('public')->delete($project->cover_image);
        }

        $project->delete();

        return redirect()->route('admin.projects.index')->with('deleted','Progetto eliminato correttamente');
    }
}
