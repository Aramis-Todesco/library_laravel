@extends('layouts.auth')

@section('title')
    <div class="col">
        <span class="h4 align-bottom">Libri</span>
    </div>
    <div class="col-auto">
        <a href="{{ route('books.create') }}" class="btn btn-sm btn-primary my-auto">Crea nuovo libro</a>
    </div>
@endsection

@section('content')
    <table class="table table-bordered table-responsive">
        <thead>
            <tr>
                <th scope="col">Titolo</th>
                <th scope="col">ISBN</th>
                <th scope="col">Autore</th>
                <th scope="col">Categoria</th>
                <th scope="col" class="w-min"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
                <tr>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->isbn }}</td>

                    {{--  
                    <td>{{ $book->author_name . " " . $book->author_surname }}</td>
                    --}}
                    <td>
                        @isset($book->authors->first()->name)
                            {{ $book->authors->first()->name . ' ' . $book->authors->first()->surname }}
                        @endisset
                    </td>

                    {{--  
                    <td>{{ $book->category }}</td>
                    --}}

                    <td>
                        @isset($book->category->name)
                            {{ $book->category->name }}
                        @endisset
                    </td>

                    <td class="text-center">
                        <a href="{{ route('books.show', $book->id) }}" class="btn btn-sm btn-secondary mx-1">APRI</a>
                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-sm btn-secondary mx-1">MODIFICA</a>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <form id="search_book_form" action="{{ route('books.search') }}" method="GET">
        @csrf
        <div class="row">
            <div class="col-6">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>
            <div class="col-6">
                <label for="isbn" class="form-label">ISBN</label>
                <input type="text" class="form-control" id="isbn" name="isbn">
            </div>
            <div class="col-6">
                <label for="publish_year" class="form-label">Publish year</label>
                <input type="text" class="form-control" id="publish_year" name="publish_year">
            </div>

            <div class="col-12 text-center">

                <button type="submit" class="btn btn-success">Cerca</button>

            </div>
        </div>
    </form>
@endsection
