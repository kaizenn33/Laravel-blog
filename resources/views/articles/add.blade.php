@extends('layouts.app');
@section('content')
    <div class="container" style="max-width: 700px;">
        <form method="post"> {{-- The form without action takes action on the same page --}}

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
                <input type="text" name="title" class="form-control">
            </div>
            <div class="mb-2">
                <label for="">Body</label>
                <input type="textarea" name="body" class="form-control">
            </div>
            <div class="mb-2">
                <label for="">Category</label>
                <select name="category_id" class="form-select">
                    @foreach ($articles as $a)
                    <option value={{$a->id}}>{{$a->name}}</option>
                    @endforeach         
                </select>
            </div>
            <button class="btn btn-primary">Add Article</button>
        </form>
    </div>
@endsection
