@extends('master')

@section('title')
    Chi Tiết Users {{ $user->name }}
@endsection

@section('content')
    <div class="table-responsive">
        <table class="table table-striped table-hover table-borderless table-primary align-middle">
            <thead class="table-light">
                <caption>
                    Chi Tiết
                </caption>
                <tr>
                    <th>trường</th>
                    <th>dữ liệu</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($user->toArray() as $key => $value)
                    <tr class="table-primary">
                        <td scope="row">{{ $key }}</td>
                        <td>
                            @switch($key)
                                @case('image')
                                    @if ($value)
                                        <img src="{{ Storage::url($value) }}" width="200px" alt="User Image">
                                    @else
                                        <span>Không có ảnh</span>
                                    @endif
                                @break

                                @case('is_active')
                                    @if ($user->is_active)
                                        <span class="badge bg-primary">yes</span>
                                    @else
                                        <span class="badge bg-danger">no</span>
                                    @endif
                                @break

                                @default
                                    {{ $value }}
                            @endswitch
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
