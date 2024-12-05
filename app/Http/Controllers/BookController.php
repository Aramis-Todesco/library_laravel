<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use App\Models\Category;
use App\Models\Author;
use App\Models\Publisher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        //prima versione

        //$books = Book::all();

        //SE VOLESSI REPERIRE ANCHE GLI AUTORI E LE CATEGORIE DEI LIBRI CHE METTO IN ELENCO?
        //DAL PUNTO DI VISTA SQL CHE QUERY DOVREI FARE?

        /*
        $books = Book::join('author_book','books.id','=','author_book.fk_book')
            ->join('authors','author_book.fk_author','=','authors.id')
            ->leftjoin('categories','books.fk_category','=','categories.id')
            ->select('books.*','authors.name as author_name','authors.surname as author_surname','categories.name as category')
            ->get();
        */

        $books = Book::all();


        return view('books.index_books')->with('books',$books);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authors = Author::all();
        $categories = Category::all();
        $publishers = Publisher::all();

        return view('books.create_books')
            ->with('authors',$authors)
            ->with('categories',$categories)
            ->with('publishers',$publishers);


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //aggiungere questa riga sopra...
        // use Illuminate\Support\Facades\Validator;

        $rules = [
            'title' => 'required|string|max:255',
            'isbn' => 'required|unique:books|string|numeric|max:13',
            'author' => 'required|integer',
            'category' => 'nullable|integer',
            'publisher' => 'nullable|integer',
            'publish_year' => 'nullable|integer|min:1500|max:2025',
            'number_pages' => 'nullable|integer|min:1',
            'language' => 'nullable|string|max:50'

            //proseguire
        ];

        $messages = [
            'required' => 'Campo obbligatorio',
            'numeric' => 'Campo numerico',
        ];

        Validator::make($request->all(), $rules, $messages)->validate();

        $book = new Book([
            'title' => $request->input('title'),
            'isbn' => $request->input('isbn'),
            'number_pages' => $request->input('number_pages'),
            'publish_year' => $request->input('publish_year'),
            'language' => $request->input('language'),
            'fk_category' => $request->input('category'),
            'fk_publisher' => $request->input('publisher'),
        ]);
        $book->save();

        $book->authors()->sync([$request->input('author')]);

        return redirect()->route('books.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //QUI DEVO REPERIRE UN DETERMINATO LIBRO DAL SUO id
        
        $book = Book::find($id);


        return view('books.show_books')->with('book',$book);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        $book = Book::find($id);

        $authors = Author::all();
        $categories = Category::all();
        $publishers = Publisher::all();

        return view('books.edit_books')
            ->with('authors',$authors)
            ->with('categories',$categories)
            ->with('publishers',$publishers)
            ->with('book',$book);


        //QUI DEVO REPERIRE UN DETERMINATO LIBRO DAL SUO id
        //POI DEVO REPERIRE EVENTUALI DATI DA ALTRE TABELLE
        //IN UTILIMO RESTITUIRE LA VIEW DI MODIFICA
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $book = Book::find($id);
        $book->update([
            'title' => $request->input('title'),
            'isbn' => $request->input('isbn'),
            'number_pages' => $request->input('number_pages'),
            'publish_year' => $request->input('publish_year'),
            'language' => $request->input('language'),
            'fk_category' => $request->input('category'),
            'fk_publisher' => $request->input('publisher'),
        ]);

        $book->authors()->sync([$request->input('author')]);

        return redirect()->route('books.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        try{
            $book = Book::find($id);

            if ($book == null) {
                throw new \Exception("Book $id not found");
            }

            $book->delete();
            $book->authors()->detach();

            DB::commit();

        }catch(\Exception $e){
            DB::rollBack();
            $errorMessage = "<h1>Error</h1>";
            return response($errorMessage, 500)->header('Content-Type', 'text/html');
        }   



        

        return redirect()->route('books.index');
    }


    public function search(Request $request){

        DB::enableQueryLog();
        
        $query = Book::query();

        if ($request->has('title')) {
            if ($request->filled('title')) {
                $query->where('title', 'LIKE', '%' . $request->input('title') . '%');
            }
        }
        if ($request->has('isbn')) {
            if ($request->filled('isbn')) {
                $query->where('isbn', 'LIKE', '%' . $request->input('isbn') . '%');
            }
        }
        if ($request->has('publish_year')) {
            if ($request->filled('publish_year')) {
                $query->where('publish_year', '=', $request->input('publish_year'));
            }
        }
        $books = $query->get();
        
        dd(DB::getQueryLog());

        return view('books.index_books')->with('books',$books);
    }
}



