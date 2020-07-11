@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('partials.sidenavbar')
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">تعديل الاسم </h1>
                </div>
                <form action="{{ route('update_registered_user', ['user_id' => $user->id]) }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="title">اسم المسخدم</label>
                        <input type="text" class="form-control" value="{{ $user->name }}" placeholder="ادخل  اسم المستخدم" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="title"> الاميل</label>
                        <input type="text" class="form-control" value="{{ $user->email }}" placeholder="ادخل  اميل  المستخدم" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="title"> النوع</label>
                        <input type="text" class="form-control" value="{{ $user->type }}" placeholder="ادخل  نوع المستخدم" name="type" required>
                    </div>
                    <button type="submit" class="btn btn-primary">تعديل</button>
                    
                </form>
            </main>
        </div>
    </div>
@endsection