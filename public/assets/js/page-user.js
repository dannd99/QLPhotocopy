const View = {
    table: {
        // private
        __table: null,
        __rows: [],
        __selected: {},
        __paginationList: [10, 20, 50, 100],
        barge: [
            "badge-gold",
            "badge-purple",
            "badge-orange",
            "badge-volcano",
            "badge-green",
            "badge-magenta",
            "badge-magenta",
        ],
        barge_title: [
            "Đang chờ",
            "Đã duyệt",
            "Đang xử lí",
            "Hoàn thiện",
            "Đã giao hàng",
            "Đã hủy",
            "Yêu cầu hủy",
        ],
        payment: [
            "badge-orange",
            "badge-geekblue",
            "badge-green",
        ],
        payment_title: [
            "Chưa thanh toán",
            "Đã thanh toán Online",
            "Đã thanh toán Offline",
        ],
        __generateDTRow(data) {

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
            this.__table.row($(`#orders-table tbody tr:eq(${id})`)[0]).data(dtRow);
        },
        deleteRow(id) {},
        render() {
            this.__table.draw();
            // check no data
            $('.dataTables_empty').html(`<img class="" style="width: 50%" src="/images/artboard_empty.jpeg" alt="Logo">`)
        },
        onRowAction(callback) {
            $(document).on('click', '.view-order', function() {
                const rowid = $(this).closest('tr').find('.id-order').html();
                callback(rowid);
            });
        },
        onTab(name, callback) {
            $(document).on('click', '.nav-tabs .nav-item', function() {
                if($(this).attr('atr').trim() == name) {
                    callback();
                }
            });
        },
        init() {
            this.__table = $('#orders-table').DataTable({
                colReorder: true,
                // fixedHeader: true,
                columns: [
                    {
                        title: 'Mã',
                        name: 'id',
                        orderable: true,
                        width: '3%',
                    },
                    {
                        title: 'Họ và tên',
                        name: 'name',
                        orderable: false,
                        width: '10%',
                    },
                    {
                        title: 'Email',
                        name: 'supplier',
                        orderable: false,
                        width: '7%',
                    },
                    {
                        title: 'Điện thoại',
                        name: 'supplier',
                        orderable: false,
                        width: '7%',
                    },
                    {
                        title: 'Địa chỉ',
                        name: 'supplier',
                        orderable: false,
                        width: '7%',
                    },
                    {
                        title: 'Trạng thái',
                        name: 'supplier',
                        orderable: false,
                        width: '7%',
                    },
                    {
                        title: 'Hành động',
                        name: 'actions',
                        orderable: false,
                        width: '10%',
                    }
                ],
                lengthChange: true,
                searching: false,
                paging: true,
                autoWidth: true,
            });
            $('.dataTables_empty').html(`<img class="" style="width: 50%" src="/images/artboard_empty.jpeg" alt="Logo">`)
        }
    },

    helper: {
        showToastSuccess(title, message) {
            $('#notification-sending .alert:first-child').remove();
            var toastHTML = `<div class="alert alert-success fade hide" data-delay="4000">
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
            }, 1000);
        },
    },
    init(){
        View.table.init();

    }
};
(() => {
    View.init();
    function getOrder(status){
        View.helper.showToastProcessing('Processing', 'Getting Order !');
         Api.Order.Read(status)
            .done(res => {
                View.helper.showToastSuccess('Success', 'Get Order Successful !');
                View.table.clearRows();
                View.table.render();
                res.map(v => {
                    View.table.insertRow(v);
                })
                View.table.render();
            })
            .fail(err => {
                console.log(err);
            })
            .always(() => {
                
            });
    }

})();



