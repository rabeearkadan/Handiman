<div id="preloader-wrapper">
    <div id="loading"></div>
</div>
@push('js')
    <script>
        function hideLoader() {
            $('#preloader-wrapper').hide();
        }
        $(window).load(function() {
            // Animate loader off screen
            $('#preloader-wrapper').fadeOut("slow");
        });

        document.addEventListener('DOMContentLoaded', function() {
            $('#preloader-wrapper').fadeOut("slow");
        });


        // $(window).ready(hideLoader);
        // setTimeout(hideLoader, 10 * 1000);
    </script>
@endpush
