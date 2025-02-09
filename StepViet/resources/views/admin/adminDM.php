@extends('admin.layout')
@section('titlepage', 'Danh sách danh mục')
@section('content')

<section>s
    <div class="container">
        <!-- Phần Form -->
        <div class="col3">
            <h2>Thêm Mới Sản Phẩm</h2>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <form action="{{ route('productadd') }}" method="post" enctype="multipart/form-data">
                @csrf
                <select name="danhmuc" id="">
                    <option value="0" selected>Chọn danh mục</option>
                </select>
                <input type="text" name="name" placeholder="Tên sản phẩm">
                <input type="submit" value="Thêm">
            </form>
        </div>

        <!-- Phần Danh Sách Sản Phẩm -->
        <div class="col9">
            <h2>Danh Sách Danh Mục</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Hình ảnh</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($danhmucs as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td><img src="{{ asset('uploads/' . $item->img) }}" width="80" alt="{{ $item->name }}"></td>
                            <td>{{ $item->tendm }}</td>
                            <td class="action-icons">
                                <a href="{{ route('productupdateform', $item->id) }}"><i class="fas fa-edit">Edit</i></a>
                                <hr> -
                                <hr>
                                <a href="{{ route('productdelete', $item->id) }}"><i class="fas fa-trash-alt">Delete</i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                {{ $products->links('pagination::default') }}
            </div>
        </div>
    </div>
</section>

@endsection