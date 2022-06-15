window.addEventListener("closemodel", event => {
    $("#addsection").modal('hide');
    $('.modal-backdrop').remove();
});

window.addEventListener('msgsuccessfull', event => {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    Toast.fire({
        icon: 'success',
        title: event.detail.title
    })
})