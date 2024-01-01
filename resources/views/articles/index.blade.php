@extends("layouts.app")
@section("content")
<div class="container" style="max-width: 800px">
    @if (session("info"))
        <div class="alert alert-warning">
            {{session("info")}}
        </div>
    @endif
    {{$articles->links()}}
    @foreach ($articles as $article )
    <div class="card mb-2">
                <div class="card-body">
                    <h4 class="card-title">{{$article->title}}</h4>
                    <div class="text-muted mb-2">
                        <b>Written by: <span class="text-primary">{{ $article->user->name }}</span></b>
                        <div class="text-primary">
                            <b>Category:</b> {{$article->category->name}}
                            |
                            <b>Comments:</b> {{count($article->comment)}}
                        </div>
                        {{$article->created_at->diffForHumans()}}
                    </div>
                    <p>{{$article->body}}</p>
                    <a href="{{url("/article/detail/$article->id")}}">View Details</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
