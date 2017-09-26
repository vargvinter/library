<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Author;
use App\Country;
use App\Http\Requests\StoreUpdateAuthorRequest;

class AuthorsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
    }

    public function index()
    {
        $authors = Author::with('country')->paginate(config('database.records_per_page'));

        return view('authors.index', compact('authors'));
    }

    public function create()
    {
        $countries = Country::orderBy('name')->get();

        return view('authors.create', compact('countries'));
    }

    public function store(StoreUpdateAuthorRequest $request)
    {
        Author::create($request->all());

        return redirect()->route('authors.index')
            ->with([
                'flash' => 'An author has been created.',
                'type' => 'success'
            ]);
    }

    public function edit(Author $author)
    {
        $countries = Country::orderBy('name')->get();

        return view('authors.edit', compact('author', 'countries'));
    }

    public function update(Author $author, StoreUpdateAuthorRequest $request)
    {
        $author->update($request->all());

        return redirect()->route('authors.index')
            ->with([
                'flash' => 'An author has been updated.',
                'type' => 'success'
            ]);
    }
}
