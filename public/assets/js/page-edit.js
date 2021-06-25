const View = {
    customer: {
        getID(){
            return {
                'id' : $('.order_id').val(),
                'customer_id' : $('.customer_id').val()
            }
        },
    },
    Services:{
        render(data){
            $('.services-list').append(
                data.map(v => {
                    return `<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                <div class="radio radio-action" value="${v.prices}">
                                    <input id="id_${v.id}" name="services_name" type="radio" value="${v.name}">
                                    <label for="id_${v.id}">${v.name}</label>
                                </div>
                            </div>`
                }).join('')
            )
        },
        onAction(callback){
            $(document).on('click', '.radio-action', function() {
                const prices = $(this).attr('value');
                callback(prices);
            });
        }
    },
    FromData:{
        resetData(){
            $('.services_prices').val('')
            $('.total_prices').val('')
            $('.url').val('')
            $('.note').val('')
            $('.printed_start').val('0')
            $('.printed_end').val('1')
        },
        prices:{
            set val(prices){
                $('.services_prices').val(prices)
            },
            get val(){
                return $('.services_prices').val()
            }
        },
        timeStart:{
            set val(data){
                $('.printed_start').val(data)
            },
            get val(){
                return $('.printed_start').val()
            }
        },
        timeEnd:{
            set val(data){
                $('.printed_end').val(data)
            },
            get val(){
                return $('.printed_end').val()
            }
        },
        pricesTotal:{
            set val(data){
                $('.total_prices').val(data)
            },
            get val(){
                return $('.total_prices').val()
            }
        },
        url:{
            set val(data){
                $('.url').val(data)
            },
            get val(){
                return $('.url').val()
            }
        },
        note:{
            set val(data){
                $('.note').val(data)
            },
            get val(){
                return $('.note').val()
            }
        },
        getFormData(){
            return {
                id              : $('.order_id').val(),
                customer_id     : $('.customer_id').val(),
                services_name   : $('.services-list').find(`input[checked='']`).val()
            }
        },
        onTimeAction(callback){
            $(document).on('keyup', '.time-action', function() {
                callback();
            });
        }
    },
    onAction(name, callback){
        $(document).on('click', '.btn-action', function() {
            if($(this).attr('atr').trim() == name) {
                callback();
            }
        });
    },
    init(){
    }
};
(() => {
    View.init();

    // lấy ra tất cả dịch vụ
    function loadData(){
        View.FromData.resetData();
        Api.Services.ReadAll()
            .done(res => {
                console.log(res)
                View.Services.render(res);
                Api.Order.ReadOne(View.customer.getID())
                    .done(res => {
                        View.FromData.timeStart.val = res.printed_start
                        View.FromData.timeEnd.val   = res.printed_end
                        View.FromData.url.val       = res.url
                        View.FromData.note.val      = res.note
                    })
                    .fail(err => {
                        $('.card-body').html(`<h1>Đơn hàng không tồn tại</h1>`)
                        console.log(err);
                    })
                    .always(() => {
                        
                    });
            })
            .fail(err => {
                console.log(err);
            })
            .always(() => {
                
            });

    }
    View.Services.onAction((prices) => {
        View.FromData.prices.val = prices
        setData()
    })
    View.FromData.onTimeAction(() => {
        setData()
    })
    function setData(){
        timeStart   = View.FromData.timeStart.val
        timeEnd     = View.FromData.timeEnd.val
        if (timeEnd - timeStart >= 0) {
            View.FromData.pricesTotal.val = (timeEnd - timeStart) * View.FromData.prices.val;
        }else{
             View.FromData.pricesTotal.val = ''
        }
    }
    View.onAction('Apply', () => {
        console.log(View.FromData.getFormData())
        // Api.Services.ReadAll()
        //     .done(res => {
        //         console.log(res)
        //         View.FormData.getFormData();
        //     })
        //     .fail(err => {
        //         console.log(err);
        //     })
        //     .always(() => {
                
        //     });
    })
    loadData();
})();



