<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">THÔNG BÁO</h4>
            </div>
            <div class="modal-body">
                <p>Bạn cần đăng nhập hoặc đăng ký trước khi có quyền để download.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div>
        </div>

    </div>
</div>
<!-- Modal -->
<form method="post" id="register_download" action="/api/superadmin/file_users">
    <div id="modalRegister" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">THÔNG BÁO</h4>
                </div>
                <div class="modal-body">
                    <p id="notice-permission" style="color: red">Bạn phải được cấp quyền mới được download.</p>
                    <div id="notice-download" style="margin: 1px;"></div>
                    {{ csrf_field() }}
                    <input type="hidden" value="{{ $file->id }}" name="file_id">
                    <input type="hidden" value="{{ empty(Auth::user()->id)? 0 : Auth::user()->id }}" name="user_id">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>SĐT: </label>
                            <input class="form-control phone-number-form" name="phone" type="text" placeholder="Nhập số điện thoại">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Email: </label>
                            <input class="form-control email-form" name="email" type="email" placeholder="Nhập email">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Lý do: </label>
                            <textarea class="form-control description-form" name="description"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info">Gửi</button>
                        <button type="button" class="btn btn-default btn-close" data-dismiss="modal">Đóng</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</form>
