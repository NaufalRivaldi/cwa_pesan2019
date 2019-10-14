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

    // khusus inbox
    // Pilih pesannya Inbox
    var x = '';
    $('.chcks').click(function () {
        if ($(this).is(':checked')) {
            x = $(this).data('class');
            $('.' + x).addClass('tb-active');
        } else {
            x = $(this).data('class');
            $('.' + x).removeClass('tb-active');
        }
    });

    // select all pesan
    $('.chckall').click(function () {
        if ($(this).is(':checked')) {
            $('.chcks').prop('checked', true);
            $('.tr-checked').addClass('tb-active');
        } else {
            $('.chcks').prop('checked', false);
            $('.tr-checked').removeClass('tb-active');
        }
    });

    // tampil menu hapus
    $('.chcks').change(function () {
        cekChecked();
    });
    $('.chckall').change(function () {
        cekChecked();
    });

    // Select2
    $(".js-example-responsive").select2();

    // select all
    $('#chckAll').click(function () {
        if ($('#chckAll').is(':checked')) {
            $("#selectAll > option").prop("selected", "selected");
            $("#selectAll").trigger("change");
        } else {
            $("#selectAll > option").prop("selected", false);
            $("#selectAll").trigger("change");
        }
    });

    // Pilih pesannya outbox
    var x = '';
    $('.chcksOutbox').click(function () {
        if ($(this).is(':checked')) {
            x = $(this).data('class');
            $('.' + x).addClass('tb-active');
        } else {
            x = $(this).data('class');
            $('.' + x).removeClass('tb-active');
        }
    });

    // select all pesan
    $('.chckallOutbox').click(function () {
        if ($(this).is(':checked')) {
            $('.chcksOutbox').prop('checked', true);
            $('.tr-checked').addClass('tb-active');
        } else {
            $('.chcksOutbox').prop('checked', false);
            $('.tr-checked').removeClass('tb-active');
        }
    });

    // tampil menu hapus
    $('.chcksOutbox').change(function () {
        cekCheckedOutbox();
    });
    $('.chckallOutbox').change(function () {
        cekCheckedOutbox();
    });

    // Select2
    $(".js-example-responsive").select2();

    // select all
    $('#chckAllOutbox').click(function () {
        if ($('#chckAllOutbox').is(':checked')) {
            $("#selectAll > option").prop("selected", "selected");
            $("#selectAll").trigger("change");
        } else {
            $("#selectAll > option").prop("selected", false);
            $("#selectAll").trigger("change");
        }
    });


    // function tambahan
    function cekChecked() {
        if ($('.chcks').is(':checked')) {
            $('#insert-menu').empty();
            $('#insert-menu').append('<a href="#" class="btn btn-danger btn-sm remove-pesan-checked" data-id="{{ $data->id }}"><i class="fas fa-trash"></i> Hapus yang ditandai</a>');
        } else {
            $('#insert-menu').empty();
        }
    }

    function cekCheckedOutbox() {
        if ($('.chcksOutbox').is(':checked')) {
            $('#insert-menu').empty();
            $('#insert-menu').append('<a href="#" class="btn btn-danger btn-sm remove-pesan-checked-outbox" data-id="{{ $data->id }}"><i class="fas fa-trash"></i> Hapus yang ditandai</a>');
        } else {
            $('#insert-menu').empty();
        }
    }
});

// tinymce
tinymce.init({
    selector: '#mytextarea',
    menubar: false,
    toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons',
    plugins: 'lists, advlist'
});
