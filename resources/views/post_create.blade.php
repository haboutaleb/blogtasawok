@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('partials.sidenavbar')
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class="align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">عمل مقالة</h1>
                </div>
                    <form action="{{ route('store_new_post') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="title">العنوان الرئيسي</label>
                            <input type="text" class="form-control"  placeholder="ادخل عنوان المقالة" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="body">محتويات المقالة</label>
                            <textarea class="form-control" rows="5" name="body" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlFile1">صورة للمقالة</label>
                            <input type="file" class="form-control-file" id="exampleFormControlFile1" name="image" required>
                        </div>
                        <button type="submit" class="btn btn-primary"> حفظ</button>
                    </form>
            </main>
        </div>
    </div>
@endsection