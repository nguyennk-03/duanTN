@extends('admin.layout')
@section('titlepage', 'Danh sách sản phẩm')
@section('content')

<section>
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
                <select name="danhmuc_id" id="">
                    <option value="0" selected>Chọn danh mục</option>
                    @foreach ($danhmucs as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                <input type="text" name="name" placeholder="Tên sản phẩm">
                <input type="text" name="price" placeholder="Giá">
                <input type="file" name="img">
                <input type="submit" value="Thêm">
            </form>
        </div>

        <!-- Phần Danh Sách Sản Phẩm -->
        <div class="col9">
            <h2>Danh Sách Sản Phẩm</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Hình ảnh</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Giá</th>
                        <th>Lượt xem</th>
                        <th>Lượt bán</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sanphams as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td><img src="{{ asset('uploads/' . $item->img) }}" width="80" alt="{{ $item->name }}"></td>
                            <td>{{ $item->tensp }}</td>
                            <td>{{ number_format($item->giaban, 0, ',', '.') }} VNĐ</td>
                            <td>{{ $item->soluong }}</td>
                            <td>{{ $item->sold }}</td>
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
                {{ $sanphams->links('pagination::default') }}
            </div>
        </div>
    </div>
</section>

@endsection