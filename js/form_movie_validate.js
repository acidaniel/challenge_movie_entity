function submit_valid() {
    console.log('test');
}

(function ($) {
    $(document).ready(
        function () {
            console.log(submit_valid());
        }
    )
})