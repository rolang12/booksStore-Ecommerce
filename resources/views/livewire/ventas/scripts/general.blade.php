<script>
    $('.tblscroll').nicescroll({
        cursorcolor: "#515365",
        cursorwidth: "30px",
        background: "rgba(20,20,20,0.3)",
        cursorborder: "0px",
        cursorborderradius: 3;

    })

    
    function Confirm(id, eventName, text) {
        swal({
            title: 'Confirm',
            text: text,
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Close',
            cancelButtonColor: '#fff',
            confirmButtonColor: '#3b3f5c',
            confirmButtonText: 'Accept'
        }).then(function(result) {
            if (result.value) {
                window.livewire.emit(eventName, id)
                swal.close()
            }
        })
    }
</script>