@extends('layouts.app')

@section('content')

<thread :initial-replies-count = "{{ $thread->replies_count}}" inline-template>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                <a href="{{route ('profile', $thread->creator)}}">{{$thread->creator->name}}</a> posted:
                <a href="{{$thread->path()}}"> {{$thread->title}} </a>
                </div>
            @can ('update', $thread)
            <form action="{{$thread->path()}}" method="POST">
                {{ csrf_field() }}
                {{ method_field('DELETE')}}
                <button type="submit" class="btn btn-link"> DELETE </button>
            </form>
            @endcan
                <div class="card-body">
                    {{$thread->body}}
                </div>
             </div>
            
            <replies @added="repliesCount++" @removed="repliesCount--"></replies>
 
            {{--  {{ $replies->links() }} --}}
            {{-- @if(auth()->check())
            <form method="POST" action="{{$thread->path() . '/replies'}}">
                        {{ csrf_field()}}
                        <div class="form-group">
                            <textarea name="body" id="body" class="form-control" placeholder="Have something to say?" rows="5" required></textarea>
                        </div>
                        <button type ="submit" class="btn btn-outline-primary">Post</button>
                    
            </form>
        @else
            <p> Please <a href="{{route('login')}}">sign in</a> to participate in this discussion. </p>   
        @endif --}}
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <p>
                        This thread was published {{ $thread->created_at->diffForHumans()}} by <a href="#">{{$thread->creator->name}}</a>,
                    and currently has <span v-text="repliesCount"></span> {{ str_plural('comment', $thread->replies_count) }}.
                    </p>

                    <p>
                    <subscribe-button :active="{{json_encode($thread->isSubscribedTo)}}"></subscribe-button>
                        

                    </p>

                </div>
             </div>
        </div>
    </div>
</div>
</thread>
@endsection



