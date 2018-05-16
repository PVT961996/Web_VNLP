@if($sentence->file->documents[0]->type == 1 && isset($sentence->file->documents[1]->type))
    {{--<div class="form-group col-sm-12 col-lg-12">--}}
    {{--{!! Form::label('file_id', 'Nhãn từ loại:') !!}--}}
    {{--<div class="scope_label">--}}
    {{--@foreach($label_types as $key => $label_type)--}}
    {{--<div class="draggable draggable2 ui-widget-content" id="{{ $key }}">--}}
    {{--<div class="col-sm-1">--}}
    {{--<button class="btn btn-default" type="button">{{ $label_type->name }}</button>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--@endforeach--}}
    {{--</div>--}}
    {{--</div>--}}
    <div class="form-group col-sm-12 col-lg-12">
        <div class="form-group col-sm-12 col-lg-12" style="padding-top: 15px;">
            {!! Form::label('content', __('messages.sentence_content')) !!}
            <input type="text" name="content" id="contentText" class="form-control"
                   value="{{ isset($sentence->content)? $sentence->content : "" }}">
        </div>
        <div class="containment">
            {{--<div class="containment-wrapper">--}}
            @foreach($label_types as $key => $label_type)
                <div class="draggable draggable2 ui-widget-content" id="{{ $key }}">
                    <div class="col-sm-1">
                        <button class="btn btn-default" type="button">{{ $label_type->name }}</button>
                    </div>
                </div>
            @endforeach
            <div class="clearfix"></div>

            @for($i = 0; $i < count($arrs); $i=$i+2)
                <div class="draggable draggable3 ui-widget-content" id="{{ $i }}">
                    <div class="col-sm-1">
                        <button class="btn btn-default" type="button"
                                style="margin-bottom: 10px;">{{ $arrs[$i] }}</button>
                        <input type="text" readonly value="{{ $arrs[$i+1] }}" id="{{ $i+1 }}" style="width: 80px;">
                    </div>
                </div>
            @endfor
        </div>
    </div>
    {{--<input type="hidden" name="content" id="contentText"--}}
    {{--value="{{ isset($sentence->content)? $sentence->content : "" }}">--}}
@elseif($sentence->file->documents[0]->type == 1)
    <div class="form-group col-sm-12 col-lg-12">
        {!! Form::label('content', __('messages.sentence_content')) !!}
        <input type="text" name="content" id="contentText" class="form-control"
               value="{{ isset($sentence->content)? $sentence->content : "" }}">
    </div>
    <div class="form-group col-sm-12 col-lg-12">

        @php
            $hide = 0;
        @endphp
        <div class="containment-wrapper">
            @foreach($words as $key => $word)
                @if(strpos($word, '_') !== false)
                    @php
                        $sub_words = explode('_', $word);
                    @endphp
                    <div class="draggable draggable4 ui-widget-content active" id="{{ $key+$hide }}"
                         style="width: 180px;">
                        @foreach($sub_words as $index => $sub_word)
                            @if($index == 0)
                                <div class="col-sm-1" style="margin-right: 40px;">
                                    <button class="btn btn-default" type="button">{{ $sub_word }}</button>
                                </div>
                            @else
                                <div class="col-sm-1">
                                    <button class="btn btn-default" type="button">{{ $sub_word }}</button>
                                </div>
                            @endif
                            @if($index < count($sub_words)-1)
                                <div class="col-sm-1">
                                    <button onclick='exchange({{ ($key+$hide) }}, 90)' class='exchange'
                                            type='button'><i class='fa fa-exchange' aria-hidden='true'></i></button>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    @php
                        $hide += count($sub_words)-1;
                    @endphp
                    @foreach(array_fill(0,count($sub_words)-1,1) as $skey=>$value)
                        <div class="draggable draggable4 ui-widget-content" style="display: none"
                             id="{{ ($hide+$key) }}">
                            <div class="col-sm-1">
                                <button class="btn btn-default" type="button">{{ $sub_words[count($sub_words)-1] }}</button>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="draggable draggable4 ui-widget-content active" id="{{ ($hide+$key) }}">
                        <div class="col-sm-1">
                            <button class="btn btn-default" type="button">{{ $word }}</button>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@else
    <!-- Content Field -->
    <div class="form-group col-sm-12 col-lg-12">
        {!! Form::label('content', __('messages.sentence_content')) !!}
        {{ Form::textarea('content', null, ['class' => 'form-control', 'id' => 'contentText']) }}
    </div>
@endif

<!-- File Id Field -->
<input type="hidden" name="file_id" value="{{ $sentence->file->id }}">
{{--<div class="form-group col-sm-6">--}}
{{--{!! Form::label('file_id', __('messages.sentence_file')) !!}--}}
{{--{!! Form::select('file_id', $fileCorpus, isset($selectedFile) ? $selectedFile : null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {{ Form::button('<i class="fa fa-save"></i> '.Lang::get('messages.save'), array('class'=>'btn btn-primary', 'type'=>'submit')) }}
    <a href="{!! route('superadmin.sentences.index') !!}" class="btn btn-default"><i
                class="fa fa-mail-reply"></i> @lang('messages.cancel')</a>
</div>