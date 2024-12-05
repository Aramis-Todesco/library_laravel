@extends('layouts.auth')

@section('title')
    <div class="col">
        <span class="h4 align-bottom">Prestiti</span>
    </div>
@endsection

@section('content')
    <table class="table table-bordered table-responsive">
        <thead>
            <tr>
                <th scope="col">Utente</th>
                <th scope="col">Book</th>
                <th scope="col">Inventory</th>
                <th scope="col">Start</th>
                <th scope="col">Expiration</th>
                <th scope="col">Status</th>
                <th scope="col" class="w-min"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($loans as $loan)
                <tr>
                    <td>{{ $loan->user->name }}</td>
                    <td>{{ $loan->copy->book->title }}</td>
                    <td>{{ $loan->copy->inventory }}</td>
                    <td>{{ $loan->loan_start_date }}</td>
                    <td>{{ $loan->loan_expiration_date }}</td>
                    <td>
                        @if($loan->status == true)
                            IN CORSO
                        @else
                            TERMINATO
                        @endif
                    </td>

                    <td class="text-center">
                        <a href="{{ route('loans.show',$loan->id) }}" class="btn btn-sm btn-secondary mx-1">APRI</a>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
