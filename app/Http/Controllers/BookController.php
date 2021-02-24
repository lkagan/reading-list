<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\BookResource;
use App\Http\Requests\BookAddRequest;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $books = Auth::user()->books()->priority()->get();
        return Inertia::render('Books', compact('books'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BookAddRequest $request
     * @return BookResource
     */
    public function store(BookAddRequest $request): BookResource
    {
        return new BookResource(
            Auth::user()->books()->create($request->only(['title', 'remote_id']))
        );
    }

    /**
     * Update the priorities of a set of Books
     *
     * @param Request $request
     * @return Response
     */
    public function reorder(Request $request)
    {
        foreach ($request->books as $book) {
            Book::where(['id' => $book['id'], 'user_id' => Auth::id()])
                ->update(['priority' => $book['priority']]);
        }

        return response('', 204);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Book $book
     * @return Response
     * @throws \Exception
     */
    public function destroy(Book $book): Response
    {
        if (Auth::user()->isNot($book->user)) {
            abort(403);
        }

        $book->delete();
        return response('', 204);
    }
}
