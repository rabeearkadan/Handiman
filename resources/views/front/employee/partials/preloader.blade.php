<div id="preloader-wrapper">
    <div id="loading"></div>
</div>
@push('js')
    <script>
        function hideLoader() {
            $('#preloader-wrapper').hide();
        }

        // $(window).load(function () {
        //     $('#preloader-wrapper').hide();
        // });
        $( window ).on( "load",function () {
            $('#preloader-wrapper').hide();
        });


        // $(window).ready(hideLoader);
        // setTimeout(hideLoader, 10 * 1000);
    </script>
@endpush
