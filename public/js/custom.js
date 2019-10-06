$(document).ready(function () {
    // Side Bar
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
        $(this).toggleClass('active');
    });

    // data table
    $('#myTable').DataTable();

    // file Upload
    $('input[name="file[]"]').fileuploader({
        theme: 'default',
        changeInput: true
    });

    // Pilih pesannya
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

    // tampil menu hapus
    $('.chcks').click(function () {
        var link = '';
        link = link + '?p1=' +
            console.log(link);
        // var link = '';
        // if ($('.chcks').is(':checked')) {
        //     $('.insert-menu').append('<a href="{{ url("admin/pesan/delete?'++'") }}" class="btn btn-primary btn-sm"><i class="fas fa-envelope"></i> Buat Pesan</a>');
        // } else {

        // }
    });
});

// tinymce
tinymce.init({
    selector: '#mytextarea',
    menubar: false,
    toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons',
    plugins: 'lists, advlist'
});
