var currentUrl = window.location.pathname
// Sending data that already changed to backend

function update(data, field, id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.post(currentUrl,
        {
            "data": data,
            "id": id,
            "field": field
        }).done(function () {
            alert('成功了')
        })
}

function create(data) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.post(currentUrl,
        {
            "data": data
        }).done(function () {
            location.reload()
        })
}

function remove(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.post(currentUrl,
        {
            "deleteId": id
        }).done(function () {
            location.reload()
        })
}
