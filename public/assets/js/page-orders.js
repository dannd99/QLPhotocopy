const View = {
    customer: {
        getID(){
            return $('.customer_id').val()
        }
    },
    table: {
        // private
        __table: null,
        __rows: [],
        __selected: {},
        __paginationList: [5,10, 20, 50, 100],
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
            return [
                `<div class="id-order">${data.id}</div>`,
                data.services_name,
                data.printed_start + ` - ` + data.printed_end,
                data.copy,
                data.slide,
                `<a href="${data.url}" class="delete-service m-l-10" target="_blank" atr="Delete" style="cursor: pointer"><i class="anticon anticon-file"></i></a> `,
                data.services_prices.replace(/\B(?=(\d{3})+(?!\d))/g, ',') + ' đ',
                data.total_prices.replace(/\B(?=(\d{3})+(?!\d))/g, ',') + ' đ',
                new Date(data.created_at).toLocaleString('vi'),
                `<span class="badge badge-pill ${this.barge[data.status]}">${this.barge_title[data.status]}</span>
                <span class="badge badge-pill ${this.payment[data.payment_status]}">${this.payment_title[data.payment_status]}</span>`,
                (data.status == 0 && data.payment_status != 1) ? `<a href="/order-edit/${data.id}" target="_blank" class="view-order" style="cursor: pointer"><i class="anticon anticon-edit"></i></a>` : `<a href="/order-view/${data.id}" target="_blank" class="view-order" style="cursor: pointer"><i class="anticon anticon-eye"></i></a>`,
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
                        title: 'Tên dịch vụ',
                        name: 'name',
                        orderable: false,
                        width: '10%',
                    },
                    {
                        title: 'Nội dung',
                        name: 'supplier',
                        orderable: false,
                        width: '7%',
                    },
                    {
                        title: 'Bản sao',
                        name: 'supplier',
                        orderable: false,
                        width: '7%',
                    },
                    {
                        title: 'Slide/Page',
                        name: 'supplier',
                        orderable: false,
                        width: '7%',
                    },
                    {
                        title: 'File',
                        name: 'tracking_number',
                        orderable: false,
                        width: '5%',
                    },
                    {
                        title: 'Đơn giá',
                        name: 'sale_channel_image',
                        orderable: false,
                        width: '10%',
                    },
                    {
                        title: 'Tổng giá',
                        name: 'sku_price',
                        orderable: false,
                        width: '10%',
                    },
                    {
                        title: 'Ngày đặt',
                        name: 'sku_price',
                        orderable: false,
                        width: '15%',
                    },
                    {
                        title: 'Trạng thái',
                        name: 'sku_price',
                        orderable: false,
                    },
                    {
                        title: 'Hành động',
                        name: 'actions',
                        orderable: false,
                        width: '10%',
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

    init(){
        View.table.init();

    }
};
(() => {
    View.init();


    const loadOrders = (resOrder) => {
        console.log(resOrder)
        View.table.clearRows();
        View.table.render();
        resOrder.map(v => {
            View.table.insertRow(v);
        })
        View.table.render();
    };

    const xhrOrder    = Api.Order.CustomerRead(View.customer.getID());
    
    $.when(xhrOrder).done((...responses) => {
        resOrder    = xhrOrder.responseJSON;
        console.log(resOrder)
        loadOrders(resOrder);
    });

})();



