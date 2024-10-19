@extends('master')

@section('title')
    Chỉnh Sửa Người Dùng {{ $user->name }}
@endsection

@section('content')
    <div class="mt-3">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session()->has('success'))
            <div class="alert alert-primary" role="alert">
                <strong>Thao Tác Thành Công</strong>
            </div>
        @endif
        <form action="{{ route('users.update', $user) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mt-3 mb-2">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}">
            </div>
            <div class="mt-3 mb-2">
                <label for="name">image</label>
                <input type="file" id="image" name="image" class="form-control">
                <img src="{{Storage::url($user->image)}}" width="200px" alt="">
            </div>
            <div class="mt-3 mb-2">
                <label for="email">email</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ $user->email }}">
            </div>
            <div class="mt-3 mb-2">
                <label for="password">password</label>
                <input type="password" id="password" name="password" class="form-control" value="{{ $user->password }}">
            </div>
            <div class="mt-3 mb-2">
                <label for="role">Role</label>
                <select name="role" id="role" class="form-control">
                    <option value="member" @selected($user->isMember())>member</option>
                    <option value="admin" @selected($user->isAdmin())>admin</option>
                </select>
            </div>
            <div class="mt-3 mb-2">
                <label for="check">is active</label>
                <input type="checkbox" class="form-checkbox" @checked($user->is_active) name="is_active" value="1">
            </div>
            <div class="mt2">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
@endsection
