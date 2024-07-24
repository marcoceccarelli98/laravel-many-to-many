<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            // 'projects' => Project::all(),

            'projects' => Project::with('technologies')->get(),
        ];

        return view('admin.projects.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();

        $technologies = Technology::all();

        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {

        // dd($request);

        $data = $request->validated();

        //Get images array from string separated by ','
        $data['images'] = array_map('trim', explode(',', $data['images']));

        //Generate slug from title
        $data['slug'] = Str::slug($data['title'], '-');


        //Attach technologies to the project
        $project = Project::create($data);

        if (isset($data['technologies'])) {
            $project->technologies()->attach($data['technologies']);
        }

        return redirect()->route('home');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {

        // $project = Project::where('slug', $slug)->first();

        $project = Project::where('slug', $slug)->with('technologies')->firstOrFail();

        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        return view('admin.projects.edit', compact('project', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $data = $request->validated();

        $data['images'] = array_map('trim', explode(',', $data['images']));

        Log::info('Update Title: ' . $data['title']);
        $data['slug'] = Str::slug($data['title'], '-');
        Log::info('Slug: ' . $data['slug']);

        $project->update($data);

        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {



        // Remove relations many-to-many
        $project->technologies()->detach();

        //Delete project
        $project->delete();

        return redirect()->route('home');
    }
}
