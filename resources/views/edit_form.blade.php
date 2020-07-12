@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('partials.sidenavbar')
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 ">
                <div class=" align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">تعديل مقالة </h1>
                </div>
                <form action="{{ route('posts.update', ['post_id' => $post->id]) }}" method="POST">
                {{ method_field('PUT') }}

                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="title">العنوان الرئيسي</label>
                        <input type="text" class="form-control" value="{{ $post->title }}" placeholder="ادخل العنوان الرئيسى" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="body">Blog Content</label>
                        <textarea class="form-control" rows="5" name="body" required>{{ $post->body }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">الصورة الرئيسية </label>
                        <input type="file" class="form-control-file" id="exampleFormControlFile1" name="image">
                    </div>
                    <button type="submit" class="btn btn-primary">تعديل</button>
                </form>
            </main>
        </div>
    </div>
@endsection