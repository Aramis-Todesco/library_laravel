@extends('layouts.auth')

@section('title')
    <div class="col">
        <span class="h4 align-bottom">Dettaglio del prestito</span><br>
    </div>
@endsection

@section('content')
    <form id="end_loan_form" action="{{ route('loans.end_loan') }}" method="POST" hidden>
        @csrf
        <input type="hidden" name="loan_id" value="{{ $loan->id }}">
        <input type="hidden" name="fk_copy" value="{{ $loan->copy->id }}">
    </form>
    
    <form id="extension_loan_form" action="{{ route('loans.extension_loan') }}" method="POST" hidden>
        @csrf
        <input type="hidden" name="loan_id" value="{{ $loan->id }}">
        <input type="hidden" name="fk_copy" value="{{ $loan->copy->id }}">
    </form>


    <div class="row g-2">

        <div class="col-6">
            <label>Inventory: </label> {{ $loan->copy->inventory }}
        </div>

        <div class="col-6">
            <label>Position: </label> {{ $loan->copy->position }}
        </div>

        <div class="col-6">
            <label>Book Title: </label> {{ $loan->copy->book->title }}
        </div>

        <div class="col-6">
            <label>ISBN: </label> {{ $loan->copy->book->isbn }}
        </div>

        <div class="col-6">
            <label>User: </label> {{ $loan->user->name }}
        </div>

        <div class="col-6">
            <label>Start Date: </label> {{ $loan->loan_start_date }}
        </div>

        <div class="col-6">
            <label>Expiration Date: </label> {{ $loan->loan_expiration_date }}
        </div>

        <div class="col-6">
            <label>End Date: </label> {{ $loan->loan_real_end_date }}
        </div>

        <div class="col-6">
            <label>Status: </label>
            @if ($loan->status == true)
                IN CORSO
            @else
                TERMINATO
            @endif
        </div>

        <div class="col-6">
            @if (now() > $loan->loan_expiration_date && $loan->status == true)
                <span class="text-bg-danger">IN RITARDO</span>
            @endif
        </div>

    </div>

    <div class="row my-2">
        <div class="col-12 text-center">

            @if ($loan->status == true)
                <a href="#" class="btn btn-sm btn-primary" onclick="$('#end_loan_form').submit();">TERMINA
                    PRESTITO</a>
                <a href="#" class="btn btn-sm btn-primary" onclick="$('#extension_loan_form').submit();">ESTENDI
                    PRESTITO</a>
            @else
                <span class="btn btn-sm btn-primary disabled">TERMINA PRESTITO</span>
                <span class="btn btn-sm btn-primary disabled">ESTENDI PRESTITO</span>
            @endif
        </div>
    </div>
@endsection
