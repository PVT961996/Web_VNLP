$(document).ready(function () {

    // thêm toottip cho button show, edit, delete
    addTooltipButton();
    autoComment();
    dragElement();
    // exchange();
    keyUpInput();
    dragTag();
});

function autoComment() {
    jQuery(".evaluatedCmt").click(function () {
        jQuery("#evaluatedCmt").val(jQuery(this).attr("id"));
    })
}

function addTooltipButton() {
    $('.glyphicon.glyphicon-eye-open').tooltip({
        title: "Xem",
        placement: "top"
    })

    $('.glyphicon.glyphicon-edit').tooltip({
        title: "Sửa",
        placement: "top"
    })

    $('.glyphicon.glyphicon-trash').tooltip({
        title: "Xóa",
        placement: "top"
    })

    $('.glyphicon.glyphicon-comment').tooltip({
        title: 'Đánh giá',
        placement: "top"
    })

    $('.fa.fa-pencil').tooltip({
        title: 'Sửa nâng cao',
        placement: "top"
    })
}

function dragElement() {
    $(".draggable4").draggable({
        containment: ".containment-wrapper", scroll: true, stop: function (event, ui) {
            for (var i = 0; i < $(".containment-wrapper>.draggable4").length; i++) {
                topO = $(this).offset().top;
                leftO = $(this).offset().left;
                if ($(".draggable4#" + i.toString()).length && i.toString().localeCompare($(this).attr('id')) != 0) {
                    topT = $(".draggable4#" + i.toString()).offset().top;
                    leftT = $(".draggable4#" + i.toString()).offset().left;
                    height = $(".draggable4#" + i.toString()).outerHeight();
                    width = $(".draggable4#" + i.toString()).outerWidth();
                    if ($(this).offset().top >= topT
                        && $(this).offset().top <= topT + height
                        && $(this).offset().left >= leftT
                        && $(this).offset().left <= leftT + width
                    ) {
                        textT = $(this).html();
                        $(".draggable4#" + i.toString() + " >div").css('margin-right', '40px');
                        $(".draggable4#" + i.toString()).append("<div class='col-sm-1'><button onclick='exchange(" + i.toString() + ", " + width + ")' class='exchange' type='button'><i class='fa fa-exchange' aria-hidden='true'></i></button></div>");
                        $(".draggable4#" + i.toString()).append(textT);
                        $(".draggable4#" + i.toString()).css('width', width + $(this).outerWidth());
                        // $(this).html('');
                        $(this).css('display', 'none');
                        $(this).removeClass('active');
                        // $(this).remove();
                        setText();
                    }
                }
            }
        }
    });
    $(".containment-wrapper").resizable();

    // $(".draggable3").draggable({
    //     containment: ".containment-wrapper", scroll: true, stop: function (event, ui) {
    //
    //     }
    // });
}

function dragTag() {
    $(".draggable2").draggable({
        containment: ".containment", scroll: true, revert: function () {
            for (var i = 0; i < 2 * $(".containment>.draggable3").length; i++) {
                if (i % 2 == 0 && $('#' + i.toString() + ".draggable3").length == 1) {
                    topT = $('#' + i.toString() + ".draggable3").offset().top;
                    leftT = $('#' + i.toString() + ".draggable3").offset().left;
                    height = $('#' + i.toString() + ".draggable3").outerHeight();
                    width = $('#' + i.toString() + ".draggable3").outerWidth();
                    if ($(this).offset().top >= topT
                        && $(this).offset().top <= topT + height
                        && $(this).offset().left >= leftT
                        && $(this).offset().left <= leftT + width
                    ) {
                        text = $('.draggable2#' + $(this).attr('id') + '>div>button').text();
                        $('.draggable3#' + i.toString() + '>div>input').val(text);
                        setTextPOST();
                    }
                }
            }
            return true;
        }, stop: function (event, ui) {
            // $(this).css("left", oldpos[$(this).attr('id')].left);
            // $(this).css("top", oldpos[$(this).attr('id')].top);
            // text = $('.draggable2#'+ $(this).attr('id')+'>div>button').text();
            // $(this).remove();
            // console.log($(this).position());
            // $('.containment').append('<div class="draggable draggable2 ui-widget-content ui-draggable ui-draggable-handle" id="0" style="position: relative; top:'+oldpos[$(this).attr('id')].top+';left:'+oldpos[$(this).attr('id')].left+'"> <div class="col-sm-1"> <button class="btn btn-default" type="button">'+text+'</button></div></div>');


        }
    });
    $(".containment-wrapper").resizable();
}

function exchange(id, width) {
    parent_div = $('.containment-wrapper>.draggable4');
    cdiv = $('.containment-wrapper>.draggable4#' + id.toString() + '>div');
    cbt = $('.containment-wrapper>.draggable4#' + id.toString() + '>div>button')
    text = cbt.eq(cbt.length - 1).text();
    cdiv.eq(cdiv.length - 1).remove();
    cdiv.eq(cdiv.length - 2).remove();
    $(".draggable4#" + id.toString() + " >div").css('margin-right', '0px');
    for (var j = 0; j < parent_div.length; j++) {
        if (text == $('.containment-wrapper>.draggable4#' + j.toString() + '>div>button').eq(0).text()) {
            $('.containment-wrapper>.draggable4#' + j.toString()).addClass('active');
            $('.containment-wrapper>.draggable4#' + j.toString()).css('display', 'block');
            $(".draggable4#" + id.toString()).css('width', width);
            setText();
        }
    }
}

function setText() {
    textC = "";
    for (var j = 0; j < $(".containment-wrapper>.draggable4").length; j++) {
        var list = $(".draggable4.active#" + j.toString() + ">div>button.btn-default");
        if (list.length == 1) {
            textC += list.text();
            textC += " ";
        }
        else if (list.length > 1) {
            for (var k = 0; k < list.length; k++) {
                textC += list.eq(k).text();
                if (k != list.length - 1) {
                    textC += "_";
                }
            }
            textC += " ";
        }
    }
    console.log(textC);
    $('#contentText').val(textC);
}

function setTextPOST() {
    contentText = "";
    word = $(".containment>.draggable3>div>button");
    tag = $(".containment>.draggable3>div>input");

    for (var i = 0; i < word.length; i++) {
        contentText += word.eq(i).text() + "/" + tag.eq(i).val();
        contentText += " ";
    }
        // for (var j = 0; j < 2 * $(".containment>.draggable3").length; j++) {
        // if (j % 2 == 0) {
        //     // word = $("#" + j.toString() + ".draggable3>div>button");
        //     // var tag = $("input#" + (j + 1).toString());
        //     contentText += word.eq(j).text() + "/" + tag.eq(j).val();
        //     contentText += " ";
        //     // textC += word.text();
        //     // textC += "/";
        //     // textC += tag.val() + " ";
        // }
    // }
    $('#contentText').val(contentText);
}

function keyUpInput() {
    $("#containment-wrapper>.draggable3>div>input").keyup(function () {
        list_label = $("#containment-wrapper>.draggable3>div>input");
        list_word = $("#containment-wrapper>.draggable3>div>button");
        contentText = "";
        for (var i = 0; i < list_word.length; i++) {
            contentText += list_word.eq(i).text() + "/" + list_label.eq(i).val();
            contentText += " ";
        }
        alert(contentText);
        $('#contentText').val(contentText);
    });
}