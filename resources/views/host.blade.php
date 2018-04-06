@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="get" action="/get_building">
            <div class="row">
            <div class="form-group col-md-4">
                <input type="text" class="form-control" name="building_link" placeholder="Nhập đường dẫn của trang web">
            </div>
            <div class="form-group col-md-2">
                <button type="submit" class="btn btn-primary">Gửi</button>
            </div>
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" name="per_page" placeholder="Nhập số trang cần crawl data">
                </div>
        </form>
    </div>
@endsection
