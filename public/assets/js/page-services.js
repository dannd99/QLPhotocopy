const View = {
    table: {
        // private
        __table: null,
        __rows: [],
        __selected: {},
        __paginationList: [10, 20, 50, 100],
        __generateDTRow(data) {
            // console.log(data)
            return [
                `<div class="id-services">${data.id}</div>`,
                data.name,
                `<img src="http://${ window.location.host + '/' + data.image}" style="width: 100px">`,
                data.prices.replace(/\B(?=(\d{3})+(?!\d))/g, ',') + ` đ`,
                data.description,
                `<div class="align-center">
                    <a class="edit-service m-l-10" href="/admin/services/edit/${data.id}" atr="Edit" style="cursor: pointer"><i class="anticon anticon-edit"></i></a>
                    <div class="delete-service m-l-10" atr="Delete" style="cursor: pointer"><i class="anticon anticon-delete"></i></div>
                </div>`,
            ];
        },
        clearRows() {
            this.__table.clear();
            this.__rows = [];
        },
        tabActive(tab_id){
            $('.nav-tabs').find('a').removeClass('active')
            $('.nav-tabs').find('li').eq(tab_id).find('a').addClass('active')
        },
        listRows() {
            return this.__rows;
        },
        getRow(id) {
            return this.__rows[id];
        },
        insertRow(data) {
            const dtRow = this.__generateDTRow(data);
            this.__table.row.add(dtRow);
            this.__rows.push(data);
        },
        updateRow(id, data) {
            if(data) {
                this.__rows[id] = data;
            }
            const dtRow = this.__generateDTRow(this.__rows[id]);
            this.__table.row($(`#services-table tbody tr:eq(${id})`)[0]).data(dtRow);
        },
        deleteRow(id) {},
        render() {
            this.__table.draw();
            // check no data
            $('.dataTables_empty').html(`<img class="" style="width: 50%" src="/images/artboard_empty.jpeg" alt="Logo">`)
        },
        onRowAction(name, callback) {
            $(document).on('click', '.edit-service', function() {
                if($(this).attr('atr').trim() == name) {
                    const rowid = $(this).closest('tr').find('.id-services').html();
                    callback(rowid);
                }
            });

            $(document).on('click', '.delete-service', function() {
                if($(this).attr('atr').trim() == name) {
                    const rowid = $(this).closest('tr').find('.id-services').html();
                    callback(rowid);
                }
            });
        },
        init() {
            this.__table = $('#services-table').DataTable({
                colReorder: true,
                // fixedHeader: true,
                columns: [
                    {
                        title: 'ID',
                        name: 'id',
                        orderable: false,
                        width: '5%',
                    },
                    {
                        title: 'Services Name',
                        name: 'name',
                        orderable: true,
                        width: '10%',
                    },
                    {
                        title: 'Services Image',
                        name: 'image',
                        orderable: true,
                        width: '10%',
                    },
                    {
                        title: 'Services Prices',
                        name: 'prices',
                        orderable: true,
                        width: '10%',
                    },
                    {
                        title: 'Services Description',
                        name: 'description',
                        orderable: true,
                        width: '30%',
                    },
                    {
                        title: 'Actions',
                        name: 'actions',
                        orderable: false,
                        width: '15%',
                    }
                ],
                lengthChange: true,
                searching: true,
                paging: true,
                autoWidth: true,
            });
            $('.dataTables_empty').html(`<img class="" style="width: 50%" src="/images/artboard_empty.jpeg" alt="Logo">`)
        }
    },
    helper: {
        showToastSuccess(title, message) {
            $('#notification-sending .alert:first-child').remove();
            var toastHTML = `<div class="alert alert-success fade hide" data-delay="2000">
                                <div class="d-flex justify-content-start">
                                    <span class="alert-icon m-r-20 font-size-30">
                                        <i class="anticon anticon-check-circle"></i>
                                    </span>
                                    <div>
                                        <h5 class="alert-heading">${title}</h5>
                                        <p>${message}</p>
                                    </div>
                                </div>
                            </div>`
                $(document).on('click', '#notification-toast .alert', function () {
                    $(this).remove();
                })
            $('#notification-toast').append(toastHTML)
            $('#notification-toast .alert').toast('show');
            setTimeout(function () {
                $('#notification-toast .alert:first-child').remove();
            }, 2000);
            // setTimeout(function () {
            //     $('#notification-toast .alert:first-child').remove();
            // }, 4000);
        },
        showToastError(title, message) {
            $('#notification-sending .alert:first-child').remove();
            var toastHTML = `<div class="alert alert-danger fade hide" data-delay="2000">
                                <div class="d-flex justify-content-start">
                                    <span class="alert-icon m-r-20 font-size-30">
                                        <i class="anticon anticon-close-circle"></i>
                                    </span>
                                    <div>
                                        <h5 class="alert-heading">${title}</h5>
                                        <p>${message}</p>
                                    </div>
                                </div>
                            </div>`
            $('#notification-toast').append(toastHTML)
            $('#notification-toast .alert').toast('show');
            // setTimeout(function () {
            //     $('#notification-toast .alert:first-child').remove();
            // }, 4000);
            setTimeout(function () {
                $('#notification-toast .alert:first-child').remove();
            }, 2000);
        },
        showToastProcessing(title, message) {
            var toastHTML = `<div class="alert alert-primary fade hide" data-delay="400000">
                                <div class="d-flex justify-content-start">
                                    <span class="alert-icon m-r-20 font-size-30">
                                        <i class="anticon anticon-loading"></i>
                                    </span>
                                    <div>
                                        <h5 class="alert-heading">${title}</h5>
                                        <p>${message}</p>
                                    </div>
                                </div>
                            </div>`
            $('#notification-sending').append(toastHTML)
            $('#notification-sending .alert').toast('show');
            setTimeout(function () {
                $('#notification-toast .alert:first-child').remove();
            }, 2000);
        },
    },
    modals: {
        servicesDelete:{
            createFormData(data){
                $('#delete-services').find('.name').val(data.name);
                $('#delete-services').find('.prices').val(data.prices);
                $('#delete-services').find('.service_id').val(data.id);
            },
            getFormData() {
                return {
                    'id' : $('#delete-services').find('.service_id').val(), 
                }
            },
            show(){
                $('#delete-services').modal(true)
            },
            hide(){
                $('#delete-services').modal('hide')
            },
            onAction(name, callback) {
                $(document).on('click', '.modal-action', function() {
                    if($(this).attr('atr').trim() == name) {
                        callback(View.modals.servicesDelete.getFormData());
                    }
                });
            },
        },
    },
    init(){
        View.table.init();

    }
};
(() => {
    View.init();

    // lấy ra tất cả dịch vụ
    function loadDataTable(){
        View.helper.showToastProcessing('Processing', 'Getting Services !');
        Api.Services.ReadAll()
            .done(res => {
                View.helper.showToastSuccess('Success', 'Get Services Successful !');
                View.table.clearRows();
                loadServices(res)
            })
            .fail(err => {
                console.log(err);
                View.helper.showToastError('Error', 'Something Wrongggg !');  
            })
            .always(() => {
                
            });
    }

    const loadServices = (data) => {
        data.map(v => {
            View.table.insertRow(v);
            View.table.render();
        })
    }

    // lấy ra dịch vụ muốn Xóa
    View.table.onRowAction("Delete", (data) => {
        View.helper.showToastProcessing('Processing', 'Getting Service !');
        console.log(data)
        Api.Services.ReadOne(data)
            .done(res => {
                View.helper.showToastSuccess('Success', 'Get Service Successful !');
                View.modals.servicesDelete.show();
                View.modals.servicesDelete.createFormData(res);
            })
            .fail(err => {
                console.log(err);
                View.helper.showToastError('Error', 'Something Wrongggg !');  
            })
            .always(() => {
                
            });
    })
    // thực hiện Xóa
    View.modals.servicesDelete.onAction('Delete', (data) => {
        View.helper.showToastProcessing('Processing', 'Loading Service !');
        View.modals.servicesDelete.hide();

        Api.Services.Delete(data.id)
            .done(res => {
                View.helper.showToastSuccess('Success', 'Delete Service Successful !');
                loadDataTable()
                window.location.reload()
            })
            .fail(err => {
                console.log(err);
                View.helper.showToastError('Error', 'Something Wrongggg !');  
            })
            .always(() => {
                
            });
    })

    loadDataTable();
})();



