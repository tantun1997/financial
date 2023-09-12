window.addEventListener("swal:notification", (event) => {
    swal({
        title: event.detail.message,
        text: event.detail.text,
        icon: event.detail.type,
        timer: 2000,
    }).then(function () {
        window.location.href = event.detail.urls;
    });
});

window.addEventListener("swal:confirm", (event) => {
    swal({
        title: event.detail.message,
        text: event.detail.text,
        icon: event.detail.type,
        buttons: true,
        dangerMode: true,
    }).then((result) => {
        if (result) {
            window.livewire.emit(event.detail.urls, event.detail.id);
        }
    });
});
