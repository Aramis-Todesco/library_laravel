@extends('layouts.auth')


@section('content')

<div class="row my-5 gy-3">

    <div class="col-12 text-center">
        <a href="{{ route('books.index') }}" class="btn btn-primary">BOOKS</a>
    </div>
    <div class="col-12 text-center">
        <a href="{{ route('loans.index') }}" class="btn btn-primary">LOANS</a>
    </div>

</div>

@endsection
