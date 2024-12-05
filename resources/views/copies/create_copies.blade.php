@extends('layouts.auth')

@section('title')
    <div class="col-12">
        <span class="h4 align-bottom">Crea nuova copia del libro</span><br>
        <span class="h5 align-bottom">Titolo:{{ $book->title }} - ISBN:{{ $book->isbn }}</span>
    </div>
@endsection

@section('content')
    <form action="{{ route('copies.store') }}" method="POST" class="my-2">
        @csrf

        <input type="hidden" value="{{ $book->id }}" name="book">

        <div class="row g-3">

            <div class="col-6">
                <label for="inventory" class="form-label">Inventory</label>
                <input type="text" class="form-control" id="inventory" name="inventory">
            </div>

            <div class="col-6">
                <label for="position" class="form-label">Position</label>
                <input type="text" class="form-control" id="position" name="position">
            </div>

            <div class="col-6">
                <label for="status" class="form-label">Status</label>
                <select class="form-control form-select" id="status" name="status">
                    <option value="1">Disponibile</option>
                    <option value="2">Non disponibile</option>
                
                </select>
            </div>

            <div class="col-6">
                <label for="condition" class="form-label">Condition</label>
                <select class="form-control form-select" id="condition" name="condition">
                    <option value="1">OK</option>
                    <option value="2">Danneggiato</option>
                    <option value="3">Smarrito</option>
                </select>
            </div>


            <div class="col-6">
                <label for="buy_date" class="form-label">Buy date</label>
                <input type="date" class="form-control" id="buy_date" name="buy_date">
            </div>

        </div>

        <div class="row my-2">
            <div class="col-12 text-center">

                <button type="submit" class="btn btn-success">Salva</button>

            </div>
        </div>
    </form>
@endsection
