@extends("layouts.app")

@section("content")
    <div class="container" style="max-width: 800px;"> 
        @if (session("info"))
            <div class="alert alert-warning">
                {{session("info")}}
            </div>
        @endif
            <div class="card mb-2 border-primary">
                <div class="card-body">
                    <h2 class="card-title">{{$article->title}}</h4>
                    <b>Written by: <span class="text-primary">{{ $article->user->name }}</span></b>
                    <div class="text-muted">
                        {{$article->created_at->diffForHumans()}}
                    </div>
                    <p style="font-size: 1.2em">{{$article->body}}</p>
                    @auth
                        @can('delete-article', $article)   
                        <a href="{{url("/article/delete/$article->id")}}" class="btn btn-outline-danger">Delete</a>
                        @endcan
                             
                        <a href="{{url("/article/update/$article->id")}}" class="btn btn-outline-primary ms-3">Edit</a>
                        
                    @endauth
                </div>
            </div>
            @auth   
            <form action="{{url("/comment/add")}}" method="post">
                @csrf
                <input type="hidden" name="article_id" value="{{$article->id}}">
                <textarea name="content" class="form-control my-3" placeholder="Enter comment.."></textarea>
                <button class="btn btn-secondary">Add Comment</button>
            </form>
            @endauth

            <ul class="list-group">
                <li class="list-group-item border-0">
                    <b>
                        Comments: {{count($article->comment)}}
                    </b>
                </li>
            </ul>
                <div class="container" style="width: 800px">
                    @foreach ($article->comment as $comment)
                    <div class="border p-2 my-2 bg-light col-md-10 rounded">
                        <b>Written by: <span class="text-primary">{{ $comment->user->name }}</span></b>
                        <div class="text-muted">
                             {{$comment->created_at->diffForHumans()}}
                        </div class="mt-2">
                        <a href="{{url("/comment/delete/$comment->id") }}" class="btn-close float-end"></a>
                            {{$comment->content}}
                    </div>
                    @endforeach
                </div>
    </div>
@endsection
