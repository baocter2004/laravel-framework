@extends('master')

@section('title')
    Danh Sách Users
@endsection

@section('content')
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
    <div class="table-responsive">
        <table class="table table-striped table-hover table-borderless table-primary align-middle">
            <thead class="table-light">
                <caption>
                    Users
                </caption>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Image</th>
                    <th>Role</th>
                    <th>Is Active</th>
                    <th>Create</th>
                    <th>Update</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($users as $user)
                    <tr class="table-primary">
                        <td scope="row">{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <img src="{{ Storage::url($user->image) }}" width="100px" alt="không có">
                        </td>
                        <td>
                            @if ($user->isAdmin())
                                <span class="badge bg-primary">Admin</span>
                            @endif
                            @if ($user->isMember())
                                <span class="badge bg-info">Member</span>
                            @endif
                        </td>
                        <td>
                            @if ($user->is_active === 1)
                                <span class="badge bg-primary">yes</span>
                            @else
                                <span class="badge bg-danger">no</span>
                            @endif
                        </td>
                        <td>{{ $user->created_at }}</td>
                        <td>{{ $user->updated_at }}</td>
                        <td>
                            <a href="{{ route('users.show',$user) }}" class="btn btn-info">Xem Chi Tiết</a>
                            <a href="{{ route('users.edit', $user) }}" class="btn btn-warning mt-3 mb-3">Sửa Thông Tin</a>
                            <form action="{{ route('users.destroy', $user) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('bạn có muốn xóa ?')" class="btn btn-danger">Xóa Người
                                    Dùng</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                {{ $users->links() }}
            </tfoot>
        </table>
    </div>
@endsection
