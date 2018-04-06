@extends('layouts.app')

@section('content')
    <div class="container">
      <br>
        <form method="get" action="/get_comment">
            <div class="form-group col-md-5">
                <input type="text" class="form-control" name="link_post" placeholder="Nhập đường dẫn đến bài viết:"
                       value="https://www.foody.vn/ha-noi/com-rang-ga-quay-ba-trieu/binh-luan">
            </div>
            <div class="form-group col-md-5">
                <input type="text" class="form-control" name="structure" placeholder="Nhập cấu trúc html:"
                       value=".rd-des > span">
            </div>
            <div class="form-group col-md-2">
                <button type="submit" class="btn btn-primary">Gửi</button>
            </div>
        </form>
        <form method="get" action="/get_comment_multiple_link">
            <div class="form-group col-md-4">
                <input type="text" class="form-control" name="all_link" placeholder="Nhập đường dẫn của trang web:"
                       value="https://www.foody.vn/ha-noi">
            </div>
            <div class="form-group col-md-2">
                <button type="submit" class="btn btn-primary">Gửi</button>
            </div>
        </form>
        <form method="get" action="/get_defind_word">
            <div class="form-group col-md-4">
                <input type="text" class="form-control" name="word" placeholder="Nhập từ cần tra định nghĩa: "
                       value="Y tế">
            </div>
            <div class="form-group col-md-2">
                <button type="submit" class="btn btn-primary">Gửi</button>
            </div>
        </form>
    </div>
@endsection
