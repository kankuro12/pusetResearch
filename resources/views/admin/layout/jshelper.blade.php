<script>
    const yes = (msg = 'Do you want to continue.') => {
        return prompt(msg) == 'yes';
    };

    toastr.options.progressBar = true;
    const success = (msg = "Operation Completed", title = "Success") => {
        toastr.success(msg, title);
    };

    const error = (msg = "Operation Failed", title = "Error") => {
        toastr.error(msg, title);
    };

    const successMessage = @json(session('success'));
    const errorMessage = @json(session('error'));

    if (successMessage) {
        success(successMessage);
    }

    if (errorMessage) {
        error(errorMessage);
    }
    $(".next").keydown(function(event) {
        var key = event.keyCode ? event.keyCode : event.which;
        // console.log(key);
        if (key == "13") {
            event.preventDefault();
            id = $(this).data("next");
            console.log("next id", id);
            $("#" + id).focus();
        }
    });
</script>
