@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('partials.sidenavbar')
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class=" align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">كل المنشورات
                    </h1>
                     <a href="{{ route('posts.create') }}" class="btn btn-primary float-right">اضف مقالة</a>
                </div>
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="row">
                    @foreach($posts as $post)
                        <div class="col-md-4">
                            <div class="card" style="width: 18rem;">
                                @if($post->image)
                                    <img class="card-img-top" src="{{ asset('images/'.$post->image) }}" alt="Blog Post Image">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $post->title }} by <small><i>{{ $post->writer->name }}</i></small></h5>
                                    <p class="card-text">
                                        {{ $post->body }}
                                    </p>
                         
                                   <a href="{{ route('posts.edit' ,$post->getRouteKey())}}" class="card-link btn btn-primary">تعديل</a>
                                    <form action="{{ route('posts.destroy', ['post_id' => $post->id]) }}" method="post"><br>
                                        {{ csrf_field() }}
                                       <button type="submit" class="btn btn-danger" >حذف</button>
                                    </form>
                                    <a href="{{ route('post.publisedPost', $post->id) }}" >
                                        {{ ($post->actived == 1) ? 'Active':'Unactive' }}
                                    </a>    
                                </div>
                               
                            </div>


                        </div>
                    @endforeach
                </div>
            </main>
        </div>
    </div>
@endsection