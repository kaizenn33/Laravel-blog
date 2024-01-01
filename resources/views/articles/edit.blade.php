@extends('layouts.app');
@section('content')
    <div class="container" style="max-width: 700px;">
        <form method="post" action="{{ url("/article/update/$oldArticle->id") }}"> {{-- The form without action takes action on the same page --}}
            @if ($errors->any()) {{-- Errors get from withError method --}}
                @foreach ($errors->all() as $err) {{-- all() is not model function, it is a function from MessageBag class to retrieve all error messages --}}
                    <div class="alert alert-warning">
                        {{ $err }}
                    </div>
                @endforeach
            @endif

            @csrf
            <div class="mb-2">
                <label for="">Title</label>
            <input type="text" name="newTitle" class="form-control" value="{{ $oldArticle->title }}">
            </div>
            <div class="mb-2">
                <label for="">Content</label>
{{-- <input type="textarea" name="newContent" class="form-control" value="{{$oldArticle->content}}"> --}}
                <textarea name="newContent" class="form-control">{{$oldArticle->content}}</textarea>
            </div>
            <div class="mb-2">
                <label for="">Category</label>
                <select name="newCategory_id" class="form-select">
                    {{-- <option value="">{{ $oldArticle->category->name }}</option> --}}
                    @foreach ($articles as $a)
                    <option value="{{ $a->id }}" @selected($a->id == $oldArticle->category_id)>{{ $a->name }}</option>
                    @endforeach
                </select>
            </div>
            <button class="btn btn-primary">Update Article</button>
        </form>
    </div>
@endsection
