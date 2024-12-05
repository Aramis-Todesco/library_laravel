@extends('layouts.auth')

@section('title')
    <div class="col">
        <span class="h4 align-bottom">Dettaglio libro</span>
    </div>

    @if(Auth::user()->role == 1)
    <div class="col-auto">
        <form id="delete_book_form" action="{{ route('books.delete',$book->id) }}" method="POST" hidden>
            @csrf
            @method('DELETE')
        </form>
        <a href="#" class="btn btn-sm btn-danger" onclick="$('#delete_book_form').submit();">ELIMINA LIBRO</a>
    </div>
    @endif

    <div class="col-auto">
        <a href="{{ route('books.create_from_book',$book->id) }}" class="btn btn-sm btn-primary my-auto">Aggiungi nuova copia</a>
    </div>
@endsection

@section('content')
    <div class="row g-2">

        <div class="col-6">
           <label>Titolo: </label> {{ $book->title }}
        </div>

        <div class="col-6">
            <label>ISBN: </label> {{ $book->isbn }}
        </div>

        <div class="col-6">
            <label>Author: </label> 
            @isset($book->authors->first()->name)
                {{ $book->authors->first()->name . " " . $book->authors->first()->surname }}
            @endisset
        </div>

        <div class="col-6">
            <label>Category: </label> 
            @isset($book->category->name)
                {{ $book->category->name }}
            @endisset
        </div>

        <div class="col-6">
            <label>Publisher: </label> 
            @isset($book->publisher->name)
                {{ $book->publisher->name }}
            @endisset
        </div>

        <div class="col-6">
            <label>Number Pages: </label> {{ $book->number_pages }}
        </div>

        <div class="col-6">
            <label>Publish Year: </label> {{ $book->publish_year }}
        </div>

        <div class="col-6">
            <label>Language: </label> {{ $book->language }}
        </div>


        @isset($book->copies)
        <div class="col-12 my-2">
            <span class="lead">Copie del libro disponibili in biblioteca: </span>
        </div>
        <table class="table table-bordered table-responsive">
            <thead>
                <tr>
                    <th scope="col">Inventory</th>
                    <th scope="col">Status</th>
                    <th scope="col">Position</th>
                    <th scope="col">Condition</th>
                    <th scope="col" class="w-min"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($book->copies as $copy)
                    <tr>
                        <td>{{ $copy->inventory }}</td>
                        <td>
                            @if($copy->status == 1)
                                Disponibile
                            @elseif($copy->status == 2)
                                Non disponibile
                            @endif
                        </td>
                        <td>{{ $copy->position }}</td>
                        <td>
                            @if($copy->condition == 1)
                                OK
                            @elseif($copy->condition == 2)
                                Danneggiato
                            @elseif($copy->condition == 3)
                                Smarrito
                            @endif
                        </td>
                        
                        <td class="text-center">
                            
                            <a href="{{ route('copies.show',$copy->id) }}" class="btn btn-sm btn-secondary mx-1">APRI</a>
                            <a href="{{ route('copies.edit',$copy->id) }}" class="btn btn-sm btn-secondary mx-1">MODIFICA</a>
                            <span class="mx-1">&bull;</span>
                            @if($copy->status == 1)
                                <a href="{{ route('loans.create',$copy->id) }}" class="btn btn-sm btn-primary mx-1">PRESTITO</a>
                            @else
                                <span class="btn btn-sm btn-primary mx-1 disabled">PRESTITO</span>
                            @endif
    
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @endisset

    </div>
@endsection
