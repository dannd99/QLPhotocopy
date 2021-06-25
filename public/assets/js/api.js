const Api = {
    Services: {},
    Order: {},
    Customer: {},
};
(() => {
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        crossDomain: true
    });
})();

// Services
(() => {
    Api.Services.ReadAll = () => $.ajax({
        url: `/api/services/getall`,
        method: 'GET',
        dataType: 'json'
    });
    Api.Services.ReadOne = (service_id) => $.ajax({
        url: `/api/services/getDelete`,
        method: 'GET',
        dataType: 'json',
        data: {
            service_id: service_id ?? '',
        }
    });
    Api.Services.Create = (data) => $.ajax({
        url: `/api/services/create`,
        method: 'POST',
        contentType: 'application/json',
        data: JSON.stringify({
            name    : data.name,
            prices  : data.prices,
        })
    });
    Api.Services.Update = (data) => $.ajax({
        url: `/api/services/update`,
        method: 'PUT',
        contentType: 'application/json',
        data: JSON.stringify({
            id      : data.id,
            name    : data.name,
            prices  : data.prices,
        })
    });
    Api.Services.Delete = (service_id) => $.ajax({
        url: `/api/services/delete`,
        method: 'DELETE',
        dataType: 'json',
        data: {
            service_id: service_id ?? '',
        }
    });
})();

// Order
(() => {
    Api.Order.ReadAll = () => $.ajax({
        url: `/api/order/getall`,
        method: 'GET',
        dataType: 'json'
    });
    Api.Order.Read = (status) => $.ajax({
        url: `/api/order/read`,
        method: 'GET',
        dataType: 'json',
        data: {
            status : status ?? '',
        }
    });
    
    Api.Order.ReadOne = (data) => $.ajax({
        url: `/api/order/getone`,
        method: 'GET',
        dataType: 'json',
        data: {
            customer_id : data.customer_id ?? '',
            id          : data.id ?? '',
        }
    });
    Api.Order.CustomerRead = (customer_id) => $.ajax({
        url: `/api/order/customerget`,
        method: 'GET',
        dataType: 'json',
        data: {
            customer_id: customer_id ?? '',
        }
    });
    Api.Order.Update = (data) => $.ajax({
        url: `/api/order/update`,
        method: 'PUT',
        contentType: 'application/json',
        data: JSON.stringify({
            id                  : data.id,
            customer_id         : data.customer_id,
            services_name       : data.services_name,
            services_prices     : data.services_prices,
            printed_start       : data.printed_start,
            printed_end         : data.printed_end,
            url                 : data.url,
            note                : data.note,
            total_prices        : data.total_prices,
        })
    });
})();

// Customer
(() => {
    Api.Customer.Update = (data) => $.ajax({
        url: `/api/customer/update`,
        method: 'PUT',
        contentType: 'application/json',
        data: JSON.stringify({
            id          : data.id,
            name        : data.name,
            address     : data.address,
            telephone   : data.telephone,
        })
    });
})();