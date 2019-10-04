$(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
        $(this).toggleClass('active');
    });

    // data table
    $('#myTable').DataTable();
});

// tinymce
tinymce.init({
    selector: '#mytextarea',
    menubar: false,
    toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons',
    plugins: 'lists, advlist'
});

// fileupload
$(document).ready(function () {
    $('input[name="file[]"]').fileuploader({
        theme: 'default',
        changeInput: true
    });
});

// pilih pesannya
$(document).ready(function () {
    var x = '';
    $('.chcks').click(function () {
        if ($(this).is(':checked')) {
            x = $(this).val();
            $('.' + x).addClass('tb-active');
        } else {
            x = $(this).val();
            $('.' + x).removeClass('tb-active');
        }
    });
});
