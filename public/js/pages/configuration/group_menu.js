$(function () {
    var $stateID, $editState, $isImgEditable = false, $content;

    var oDataList = $('.group-menu-list').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: _baseURL + '/group-menu/fn_get_data',
            data: function (d) {
                // Additional parameters if needed
            }
        },
        "fnDrawCallback": function (oSettings) {
            $(".styled").uniform();
        },
        columns: [
            { data: 'name', name: 'name' },
            { data: 'sequence', name: 'sequence' },
            { data: 'action', searchable: false, orderable: false, width: '15%' },
        ],
        "order": [[1, "asc"]],
    });
    $tableState = oDataList;

    $('.dataTables_length').css('margin-right', '1em');
    $('.dataTables_length select').select2({
        minimumResultsForSearch: Infinity,
        width: 'auto'
    });

    $(document).ready(function () {
        $('#btnAddNew').on('click', function () {
            $('#createModalContent').load('/path/to/be_group_menu_create.blade.php', function () {
                $('#createModal').modal('show');
            });
        });
    });

    $('.btnCreate').on('click', function () {
        $.ajax({
            url: _baseURL + '/group-menu/create',
            type: 'GET',
            dataType: 'json',
            data: {},
            success: function (d) {
                if (d.status == 200) {
                    $('.create-modal').empty().append(d.template);
                    $('.select-search').select2({
                        search: true
                    });
                }
            },
            // beforeSend: function() {
            //     blockUI('body')
            // },
            // complete: function() {
            //     unblockUI('body')
            // }
        })
    });

    $(document).on('click', '.btnDetail', function () {
        var id = $(this).data('id');
        $.ajax({
            url: _baseURL + '/group-menu/show/' + id,
            type: 'GET',
            dataType: 'json',
            success: function (d) {
                if (d.status == 200) {
                    $('.detail-modal').empty().append(d.template);
                    // Panggil Select2 setelah template berhasil di-load
                    $('.select-search').select2({
                        search: true
                    });
                    // Tampilkan modal setelah konten berhasil dimuat
                    $('#detailModal').modal('show');
                } else {
                    alert(d.message);
                }
            },
            // Kamu bisa aktifkan blockUI jika ingin loading animation
            // beforeSend: function() {
            //     blockUI('body')
            // },
            // complete: function() {
            //     unblockUI('body')
            // }
        });
    });

    $(document).on('click', '.btnEdit', function () {
        var id = $(this).data('id');
        $.ajax({
            url: _baseURL + '/group-menu/edit/' + id,
            type: 'GET',
            dataType: 'json',
            success: function (d) {
                if (d.status == 200) {
                    $('.edit-modal').empty().append(d.template);
                    // Panggil Select2 setelah template berhasil di-load
                    $('.select-search').select2({
                        search: true
                    });
                    // Tampilkan modal setelah konten berhasil dimuat
                    $('#editModal').modal('show');
                } else {
                    alert(d.message);
                }
            },
            // Kamu bisa aktifkan blockUI jika ingin loading animation
            // beforeSend: function() {
            //     blockUI('body')
            // },
            // complete: function() {
            //     unblockUI('body')
            // }
        });
    });

    // NEW CREATE
    // $('.btnCreate').on('click', function () {
    //     if ($('.container-fluid').length == 0) {
    //         $editState = false;
    //         $.ajax({
    //             url: _baseURL + '/group-menu/create',
    //             type: 'GET',
    //             dataType: 'json',
    //             data: {},
    //             success: function (d) {
    //                 if (d.status == 200) {
    //                     $('.content-input').empty().append(d.template);
    //                     var infoSwitch = document.querySelectorAll('.switchery');
    //                     for (var i = 0; i < infoSwitch.length; i++) {
    //                         var switchery = new Switchery(infoSwitch[i], { color: '#27ad38' });
    //                     }
    //                 }
    //             },
    //             beforeSend: function () {
    //                 $.blockUI(); // Block the UI
    //             },
    //             complete: function () {
    //                 $.unblockUI(); // Unblock the UI
    //             }
    //         })
    //     }
    // });

    // SAVE PROCESS
    $('.create-modal').on('click', '.btnCreate', function (e) {
        // Setup validation
        // optValidate.rules = {};
        // optValidate.message = {};
        // $("#frmCreate").validate(optValidate);

        if ($('#frmCreate').valid()) {

            var form = $('#frmCreate')[0];
            var formData = new FormData(form);

            console.log($('#frmCreate').serialize());

            formData.append('is_edit', $editState ? 1 : 0);

            $.ajax({
                url: _baseURL + '/group-menu/store',
                type: 'post',
                dataType: 'json',
                data: formData,
                processData: false,
                contentType: false,
                success: function (d) {
                    if (d.status == 200) {
                        $('.modal').modal('hide');
                        oDataList.draw();
                        $('.frmCreate').empty();

                        // if ($editState) {
                        //     showNoty('Group Menu data successfully updated', 'success');
                        // } else {
                        //     showNoty('A new Group Menu data successfully created', 'success');
                        // }
                    } else {
                        showNoty(d.message, 'error');
                    }
                },
                error: function (xhr) {
                    console.log(xhr);
                },
            });

            e.stopImmediatePropagation();
            return false;
        }

    });

    // CANCEL INPUT
    $('.content-input').on('click', '.cancelInput', function () {
        blockUI('body');
        $('.content-input').fadeOut(function () {
            unblockUI('body')
            $('.content-input').empty().show();
        });
    });

    // DELETE DATA
    $('.group-menu-list').on('click', '.btnDelete', function () {
        $('.content-input').fadeOut(function () {
            $('.content-input').empty().show();
        });
        var tr = $(this).closest('tr');
        var data = oDataList.row(tr).data();
        deleteTableList(oDataList, 'group-menu/delete', [data.id], true);
        return false;
    });

    // EDIT DATA
    $('.group-menu-list').on('click', '.btnEdit', function () {
        var tr = $(this).closest('tr');
        var data = oDataList.row(tr).data();
        editDataView(data.id);
    });

    function editDataView($dataID) {
        $editState = true;
        $stateID = $dataID;
        $.ajax({
            url: _baseURL + '/group-menu/edit/' + $dataID,
            dataType: 'json',
            data: {},
            success: function (d) {
                if (d.status == 200) {
                    $('.content-input').empty().append(d.template);
                    var infoSwitch = document.querySelectorAll('.switchery');
                    for (var i = 0; i < infoSwitch.length; i++) {
                        var switchery = new Switchery(infoSwitch[i], { color: '#27ad38' });
                    }
                    $(document).scrollTop(0);
                }
            },
            error: function (xhr) {
                console.log(xhr)
            },
            beforeSend: function () {
                blockUI('body')
            },
            complete: function () {
                unblockUI('body')
            }
        });
    }
});