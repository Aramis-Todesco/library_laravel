@extends('layouts.auth')

@section('title')
    <div class="col">
        <span class="h4 align-bottom">Dettaglio copia del libro</span><br>
        <span class="h5 align-bottom">Titolo:{{ $copy->book->title }} - ISBN:{{ $copy->book->isbn }}</span>
    </div>
    <div class="col-auto">
        <form id="delete_copy_form" action="{{ route('copies.destroy',$copy->id) }}" method="POST" hidden>
            @csrf
            @method('DELETE')
        </form>
        <a href="#" class="btn btn-sm btn-danger" onclick="$('#delete_copy_form').submit();">ELIMINA COPIA</a>
    </div>
@endsection

@section('content')
    <div class="row g-2">

        <div class="col-6">
           <label>Inventory: </label> {{ $copy->inventory }}
        </div>

        <div class="col-6">
            <label>Position: </label> {{ $copy->position }}
        </div>

        <div class="col-6">
            <label>Status: </label> 
            @if($copy->status == 1)
                Disponibile
            @elseif($copy->status == 2)
                Non disponibile
            @endif
        </div>

        <div class="col-6">
            <label>Condition: </label> 
                @if($copy->condition == 1)
                    OK
                @elseif($copy->condition == 2)
                    Danneggiato
                @elseif($copy->condition == 3)
                    Smarrito
                @endif
        </div>

        <div class="col-6">
            <label>Buy date: </label> {{ $copy->buy_date }}
        </div>

    
    </div>
@endsection
