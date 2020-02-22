$(function(){
    // data table
    $('#myTable').DataTable();
    $('#myTable2').DataTable({
        paging: false
    });
    $('.myTable').DataTable({});
    $('.myTableExport').DataTable({
        buttons: [
            'excel'
        ]
    });
});

$(document).ready(function () {
    // Side Bar
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
        $(this).toggleClass('active');
    });

    // file Upload
    $('input[name="file[]"]').fileuploader({
        limit: null,
        changeInput: true,
        dragDrop: {
            // set the drop container {null, String, jQuery Object}
            // example: 'body'
            container: null,

            // Callback fired on entering with dragging files the drop container
            onDragEnter: function (event, listEl, parentEl, newInputEl, inputEl) {
                // callback will go here
            },

            // Callback fired on leaving with dragging files the drop container
            onDragLeave: function (event, listEl, parentEl, newInputEl, inputEl) {
                // callback will go here
            },

            // Callback fired on dropping the files in the drop container
            onDrop: function (event, listEl, parentEl, newInputEl, inputEl) {
                // callback will go here
            }
        }
    });

    // Select2
    $(".js-example-responsive").select2();

    // khusus inbox =================================================================
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

    // khusus outbox =================================================================
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

    // end =================================================================

    // khusus trash =================================================================
    // Pilih pesannya trash
    var x = '';
    $('.chckstrash').click(function () {
        if ($(this).is(':checked')) {
            x = $(this).data('class');
            $('.' + x).addClass('tb-active');
        } else {
            x = $(this).data('class');
            $('.' + x).removeClass('tb-active');
        }
    });

    // select all pesan
    $('.chckalltrash').click(function () {
        if ($(this).is(':checked')) {
            $('.chckstrash').prop('checked', true);
            $('.tr-checked').addClass('tb-active');
        } else {
            $('.chckstrash').prop('checked', false);
            $('.tr-checked').removeClass('tb-active');
        }
    });

    // select all
    $('#chckAlltrash').click(function () {
        if ($('#chckAlltrash').is(':checked')) {
            $("#selectAll > option").prop("selected", "selected");
            $("#selectAll").trigger("change");
        } else {
            $("#selectAll > option").prop("selected", false);
            $("#selectAll").trigger("change");
        }
    });

    // end =================================================================

    // function tambahan
    function cekChecked() {
        if ($('.chcks').is(':checked')) {
            $('#insert-menu').empty();
            $('#insert-menu').append('<a href="#" class="btn btn-danger btn-sm remove-pesan-checked" data-id="{{ $data->id }}"><i class="far fa-trash-alt"></i> Hapus yang ditandai</a>');
        } else {
            $('#insert-menu').empty();
        }
    }

    function cekCheckedOutbox() {
        if ($('.chcksOutbox').is(':checked')) {
            $('#insert-menu').empty();
            $('#insert-menu').append('<a href="#" class="btn btn-danger btn-sm remove-pesan-checked-outbox" data-id="{{ $data->id }}"><i class="far fa-trash-alt"></i> Hapus yang ditandai</a>');
        } else {
            $('#insert-menu').empty();
        }
    }

    // sesuaikan tanggal gan
    $('.tgl_a').change(function () {
        var date = $(this).val();
        $('.tgl_b').val(date);
    });

    // tampil select lembur
    $('.kategori').click(function () {
        if ($(this).is(':checked') && $(this).data('value') == 'Lembur') {
            $('.show-lembur').append('<select name="lembur" class="form-control"><option value="1">Berbayar</option><option value="2">Tidak Berbayar</option></select>');
            $(".kategori").attr("disabled", true);
            $(this).removeAttr("disabled");
            $(".kategori"). prop("checked", false);
            $(this). prop("checked", true);
        } else {
            $('.show-lembur').empty();
            $('.kategori').removeAttr("disabled");
        }
    });

    // set dep
    var nilai = $('.dep-select option:selected').val();
    $('.dep').empty();
    $('.dep').append(nilai);
});

// tinymce
tinymce.init({
    selector: '#mytextarea',
    menubar: false,
    toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons',
    plugins: 'lists, advlist'
});
