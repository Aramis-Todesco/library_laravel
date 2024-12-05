@extends('layouts.auth')

@section('title')
    <div class="col-12">
        <span class="h4 align-bottom">Modifica libro</span>
    </div>
@endsection

@section('content')
    <form action="{{ route('books.update',$book->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="row g-3">

            <div class="col-6">
                <label for="isbn" class="form-label">ISBN</label>
                <input type="text" class="form-control" id="isbn" name="isbn"
                 value="{{ $book->isbn }}">
            </div>

            <div class="col-6">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title"
                 value="{{ $book->title }}">
            </div>

            <div class="col-6">
                <label for="author" class="form-label">Author</label>
                <select class="form-control form-select" id="author" name="author">

                    @foreach ($authors as $author)
                        <option @selected($author->id == $book->authors->first()->id) value="{{ $author->id }}">
                            {{ $author->name . " " . $author->surname }}
                        </option>
                    @endforeach

                </select>
            </div>

            <div class="col-6">
                <label for="category" class="form-label">Category</label>
                <select class="form-control form-select" id="category" name="category">
                
                    @foreach ($categories as $category)
                        <option @selected($category->id == $book->fk_category) value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                
                </select>
            </div>

            <div class="col-6">
                <label for="publisher" class="form-label">Publisher</label>
                <select class="form-control form-select" id="publisher" name="publisher">
                    
                    @foreach ($publishers as $publisher)
                        <option value="{{ $publisher->id }}">
                            {{ $publisher->name }}
                        </option>
                    @endforeach

                </select>
            </div>

            <div class="col-6">
                <label for="publish_year" class="form-label">Publish Year</label>
                <input type="text" class="form-control" id="publish_year" name="publish_year" 
                value="{{ $book->publish_year }}">
            </div>

            <div class="col-6">
                <label for="number_pages" class="form-label">Number Pages</label>
                <input type="number" class="form-control" id=number_pages" name="number_pages" 
                value="{{ $book->number_pages }}">
                </select>
            </div>

            <div class="col-6">
                <label for="language" class="form-label">Language</label>
                <input type="text" class="form-control" id="language" name="language" 
                value="{{ $book->language }}">
            </div>

        </div>

        <div class="row my-2">
            <div class="col-12 text-center">

                <button type="submit" class="btn btn-success">Salva</button>

            </div>
        </div>
        
    </form>
@endsection
