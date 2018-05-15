@if(Auth::guest())
    <a href="#" data-placement="right" title="Tải về" id="btnDownload"
       data-toggle="modal" data-target="#myModal"><i
                class="fa fa-download"></i> Tải về</a>
@else
    @php
    $file_user=$file_users->first(function ($value) use ($file) { return $value->file_id == $file->id; });
    @endphp
    @if(!empty($file_user) && $file_user->status == 1)
        <a href="{{ $file->file }}" data-toggle="tooltip"
           data-placement="right" title="Tải về" download><i
                    class="fa fa-download"></i> Tải về</a>
    @else
        <a href="#" data-placement="right" title="Tải về" id="btnDownload"
           data-toggle="modal" data-target="#modalRegister"><i
                    class="fa fa-download"></i> Tải về</a>
    @endif
@endif