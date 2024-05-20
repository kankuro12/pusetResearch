<script>
    const submissionStatues={!! json_encode(submissionStatues()) !!};
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

    function timeAgo(o){let r=new Date,e=Math.floor((r-o)/1e3),f=Math.floor(e/60),n=Math.floor(f/60),t=Math.floor(n/24),l=Math.floor(t/7),s=Math.floor(t/30);if(e<60)return`${e} seconds ago`;if(f<60)return`${f} minutes ago`;if(n<24)return`${n} hours ago`;if(t<7)return`${t} days ago`;if(l<4)return`${l} weeks ago`;else if(s<12)return`${s} months ago`;else return`${Math.floor(t/365)} years ago`}
</script>
