<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;

class QuestionsController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            // 'auth',
            new Middleware('auth', except: ['index', 'show']),
            // new Middleware('auth', except: ['index','create']),
            // new Middleware('auth', only: ['create', 'store', 'edit','destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = Question::leftJoin('users', 'questions.user_id', '=', 'users.id')
            ->select([
                'questions.*',
                'users.name as user_name',
            ])
            // ->orderBy('created_at','DESC')
            ->latest()
            ->paginate(5);
        return view('questions.index', [
            'title' => 'Questions',
            'user' => Auth::user(),
            'questions' => $questions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('questions.create', [
            'title' => 'New Question',
            'user' => Auth::user(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ]);

        $request->merge([
            'user_id' => Auth::id()
        ]);
        $question = Question::create($request->all());

        return redirect()->route('questions.index')
            ->with('success', 'Question added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $question = Question::leftJoin('users', 'questions.user_id', '=', 'users.id')
            ->select([
                'questions.*',
                'users.name as user_name',
            ])->findOrFail($id);
        return view('questions.show', [
            'question' => $question,
            'title' => 'Show Question',
            'user' => Auth::user(),

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $question = Question::findOrFail($id);
        return view('questions.edit', [
            'question' => $question,
            'title' => 'Edit Question',
            'user' => Auth::user(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $question = Question::findOrFail($id);

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'status' => ['in:open,closed'],
        ]);

        $question->update($request->all());

        return redirect()->route('questions.index')
            ->with('success', 'Question updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Question::destroy($id);
        return redirect()->route('questions.index')
            ->with('success', 'Question deleted!');
    }
}
