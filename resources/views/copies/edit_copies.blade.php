@extends('layouts.auth')

@section('title')
    <div class="col-12">
        <span class="h4 align-bottom">Modifica copia del libro</span><br>
        <span class="h5 align-bottom">Titolo:{{ $copy->book->title }} - ISBN:{{ $copy->book->isbn }}</span>
    </div>
@endsection

@section('content')
    <form action="{{ route('copies.update',$copy->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="row g-3">

            <div class="col-6">
                <label for="inventory" class="form-label">Inventory</label>
                <input type="text" class="form-control" id="inventory" name="inventory" value="{{ $copy->inventory }}">
            </div>

            <div class="col-6">
                <label for="position" class="form-label">Position</label>
                <input type="text" class="form-control" id="position" name="position" value="{{ $copy->position }}"">
            </div>

            <div class="col-6">
                <label for="status" class="form-label">Status</label>
                <select class="form-control form-select" id="status" name="status">
                    <option value="1" @selected($copy->status == 1)>Disponibile</option>
                    <option value="2" @selected($copy->status == 2)>Non disponibile</option>
                
                </select>
            </div>

            <div class="col-6">
                <label for="condition" class="form-label">Condition</label>
                <select class="form-control form-select" id="condition" name="condition">
                    <option value="1" @selected($copy->condition == 1)>OK</option>
                    <option value="2" @selected($copy->condition == 2)>Danneggiato</option>
                    <option value="3" @selected($copy->condition == 3)>Smarrito</option>
                </select>
            </div>


            <div class="col-6">
                <label for="buy_date" class="form-label">Buy date</label>
                <input type="date" class="form-control" id="buy_date" name="buy_date" value="{{ $copy->buy_date }}">
            </div>

        </div>

        <div class="row my-2">
            <div class="col-12 text-center">

                <button type="submit" class="btn btn-success">Salva</button>

            </div>
        </div>
        
    </form>
@endsection
