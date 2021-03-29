$(document).on('change', '#images', function () {
    var i = $(this).prev('label').clone();
    var file = $(this)[0].files[0].name;
    $(this).prev('label').text(file);
});

const cloneFile = (e) => {
    fileForm = $(".multi-file-images").eq(0).clone();
    fileForm.find('input').val("");
    fileForm.find('.custom-file-label').text("Chọn ảnh");
    fileForm.insertBefore($(e));
}

function clearFile(e) {
    if ($('.multi-file-images').length == 1) {
        $(e).prevAll('input').val("");
        $(e).prevAll('.custom-file-label').text("Chọn ảnh");
    } else {
        $(e).prev().prev('.multi-file-images').remove();
    }
}

function numberWithCommas(x) {
    return x.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ".");
}
