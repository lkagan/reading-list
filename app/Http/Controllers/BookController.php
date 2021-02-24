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
     * @return Response
     */
    public function index()
    {
        return Inertia::render('Books',['books' => Auth::user()->books]);
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
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Book $book
     * @return Response
     */
    public function update(Request $request, Book $book)
    {
        //
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
