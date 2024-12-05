@extends('layouts.auth')

@section('title')
    <div class="col-12">
        <span class="h4 align-bottom">Nuovo prestito</span>
    </div>
@endsection

@section('content')

    <form action="{{ route('loans.store') }}" method="POST" class="my-2">
        @csrf

        <input type="hidden" value="{{ $copy->id }}" name="copy">

        <div class="row g-3">

            <div class="col-6">
                <label>Inventory: </label> {{ $copy->inventory }}
             </div>
     
             <div class="col-6">
                 <label>Position: </label> {{ $copy->position }}
             </div>

             <div class="col-6">
                <label>Book Title: </label> {{ $copy->book->title }}
             </div>
     
             <div class="col-6">
                 <label>ISBN: </label> {{ $copy->book->isbn }}
             </div>

            <div class="col-6">
                <label for="user" class="form-label">User</label>
                <select class="form-control form-select" id="user" name="user">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                
                </select>
            </div>

        </div>

        <div class="row my-2">
            <div class="col-12 text-center">

                <button type="submit" class="btn btn-success">AVVIA PRESTITO</button>

            </div>
        </div>
    </form>
@endsection
