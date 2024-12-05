<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Copy;
use Illuminate\Http\Request;

class CopyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort(404);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create_from_book($id)
    {
        $book = Book::find($id);
        return view('copies.create_copies')
            ->with('book',$book);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $copy = new Copy([
            'inventory' => $request->input('inventory'),
            'status' => $request->input('status'),
            'condition' => $request->input('condition'),
            'position' => $request->input('position'),
            'buy_date' => $request->input('buy_date'),
            'fk_book' => $request->input('book'),
        ]);
        $copy->save();

        return redirect()->route('books.show',$request->input('book'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $copy = Copy::find($id);

        return view('copies.show_copies')->with('copy',$copy);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $copy = Copy::find($id);
        return view('copies.edit_copies')->with('copy',$copy);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $copy = Copy::find($id);
        $copy->update([
            'inventory' => $request->input('inventory'),
            'status' => $request->input('status'),
            'condition' => $request->input('condition'),
            'position' => $request->input('position'),
            'buy_date' => $request->input('buy_date'),
        ]);

        return redirect()->route('books.show',$copy->fk_book);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $copy = Copy::find($id);
        $copy->delete();

        return redirect()->route('books.show',$copy->fk_book);
    }
}
