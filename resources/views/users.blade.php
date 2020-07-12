@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('partials.sidenavbar')
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10">
                <div class=" align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Registered Users</h1>
                </div>
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">الاسم</th>
                        <th scope="col">الاميل</th>
                        <th scope="col">تاريخ الانضمام</th>
                        <th scope="col"> النوع</th>
                        <th scope="col"> العمليات</th>


                    </tr>
                    </thead>
                    <tbody>
                  

                   
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at->format('d-m-Y') }}</td>
                            <td>{{ $user->type }}</td>
                           <td><a href="{{ route('users.edit', ['user_id' => $user->id]) }}" class="card-link btn btn-primary">تعديل</a>
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-danger" >حذف</button>
                                    </form><td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </main>
        </div>
    </div>
@endsection