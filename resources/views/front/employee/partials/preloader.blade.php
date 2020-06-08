<div id="preloader-wrapper">
    <div id="loading"></div>
</div>
@push('js')
    <script>
        function hideLoader() {
            $('#preloader-wrapper').hide();
        }

        $(window).load(function () {
            $('#preloader-wrapper').fadeOut("slow");
        });
        // setInterval(function(){
        //     $('#preloader-wrapper').fadeOut("slow");
        // },3000);

        // $(window).ready(hideLoader);
        // setTimeout(hideLoader, 10 * 1000);
    </script>
@endpush
