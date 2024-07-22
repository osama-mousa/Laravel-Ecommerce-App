<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class TagsController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            // 'auth',
            // new Middleware('auth', except: ['index','create']),
            new Middleware('auth', only: ['create', 'store', 'edit','destroy']),
            // new Middleware('subscribed', except: ['index']),
        ];
    }
    public function index()
    {
        $tags = Tag::all();
        return view("tags.index", [
            "title" => "Tags List",
            "tags" => $tags,
            "user" => Auth::user(),
        ]);
    }

    public function create()
    {
        return view("tags.create", [
            "title" => "Create New Tag",
            'tag' => new Tag(),
            "user" => Auth::user(),
            
        ]);
    }

    public function store(TagRequest $request)
    {
        // dd($request->except("_token"));
        // $this->validateRequest($request);


        /**
         * first way to insert data
         *  **/
        // $tag = new Tag();
        // $tag->name = $request->name;
        // $tag->save();

        /**
         * another ways to insert data
         * **/
        // 1
        // $tag = Tag::create([
        //     'name' => $request->name,
        // ]);

        // -------------
        // $request->merge([
        //     'slug'=> Str::slug($request->name),
        // ]);
        // -------------

        // 2
        $tag = Tag::create($request->all());

        // 3
        // $tag = new Tag($request->all());
        // $tag->save();

        // 4
        // $tag = new Tag();
        // $tag->fill($request->all())->save();
        // or
        // $tag->forceFill($request->all())->save();

        Session::flash('success', 'Tag Created Successfuly!');
        // Session::flash('info', $tag->name);

        return redirect('/tags'); //->with("success", "Tag Created Successfuly!");
    }

    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        // dd($tag);
        return view("tags.edit", [
            "title" => "Edit Tag",
            'tag' => $tag,
            "user" => Auth::user(),

        ]);
    }

    public function update(TagRequest $request, $id)
    {
        // $this->validateRequest($request, $id);

        $tag = Tag::findOrFail($id);
        $tag->update($request->all());
        return redirect('/tags')->with('success', 'Tag Updated!');
    }
    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();
        return redirect('/tags')->with('success', 'Tag Deleted!');
    }

    protected function validateRequest(Request $request, $id = 0)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:50', "unique:tags,name,$id"],
            // 'between:3,50'
        ]);
    }
}
