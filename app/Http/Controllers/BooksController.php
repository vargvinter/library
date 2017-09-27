<?php

namespace App\Http\Controllers;

use App\Author;
use App\Book;
use App\Country;
use App\Filters\BooksFilter;
use App\Http\Requests\StoreUpdateBookRequest;

class BooksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
    }

    public function index(BooksFilter $filter)
    {
        $books = Book::filter($filter)->paginate(config('database.records_per_page'));

        if (\request()->wantsJson()) {
            return $books;
        }

        return view('books.index', compact('books'));
    }

    public function create()
    {
        $authors = Author::orderBy('surname')->get();
        $countries = Country::orderBy('name')->get();

        return view('books.create', compact('authors', 'countries'));
    }

    public function store(StoreUpdateBookRequest $request)
    {
        $book = Book::create($request->all());
        $book->translations()->attach($request->country_id);

        return redirect()->route('home')
            ->with([
                'flash' => 'A book has been created.',
                'type' => 'success'
            ]);
    }

    public function edit(Book $book)
    {
        $authors = Author::orderBy('surname', 'name')->get();
        $countries = Country::orderBy('name')->get();

        return view('books.edit', compact('book', 'authors', 'countries'));
    }

    public function update(Book $book, StoreUpdateBookRequest $request)
    {
        $book->update($request->all());
        $book->translations()->sync($request->country_id);

        return redirect()->route('home')
            ->with([
                'flash' => 'A book has been updated.',
                'type' => 'success'
            ]);
    }
}
