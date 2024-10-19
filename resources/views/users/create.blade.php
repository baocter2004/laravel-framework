@extends('master')

@section('title')
    Thêm Mới Người Dùng
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
        <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mt-3 mb-2">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}">
            </div>
            <div class="mt-3 mb-2">
                <label for="name">image</label>
                <input type="file" id="image" name="image" class="form-control">
            </div>
            <div class="mt-3 mb-2">
                <label for="email">email</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}">
            </div>
            <div class="mt-3 mb-2">
                <label for="password">password</label>
                <input type="password" id="password" name="password" class="form-control" value="{{ old('password') }}">
            </div>
            <div class="mt-3 mb-2">
                <label for="role">Role</label>
                <select name="role" id="role" class="form-control">
                    <option value="member" selected>member</option>
                    <option value="admin">admin</option>
                </select>
            </div>
            <div class="mt-3 mb-2">
                <label for="check">is active</label>
                <input type="checkbox" class="form-checkbox" name="is_active" value="1">
            </div>
            <div class="mt2">
                <button type="submit" class="btn btn-primary">Gửi</button>
            </div>
        </form>
    </div>
@endsection
