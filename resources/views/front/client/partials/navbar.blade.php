<nav class="nav">
    <a href="#" class="nav-item @if (  request()->is('/client/home'))) is-active @endif" active-color="orange">Home</a>
    <a href="{{route('client.service')}}"  class="nav-item @if ( request()->is('/client/services')) is-active @endif" active-color="green">Services</a>
    <a href="#" class="nav-item" active-color="blue">Requests</a>
    <a href="#" class="nav-item" active-color="red">Profile</a>
    <span class="nav-indicator"></span>
</nav>


@push('js')
    <script>
        const indicator = document.querySelector('.nav-indicator');
        const items = document.querySelectorAll('.nav-item');
        function handleIndicator(el) {
            items.forEach(item => {
                item.classList.remove('is-active');
                item.removeAttribute('style');
            });

            indicator.style.width = `${el.offsetWidth}px`;
            indicator.style.left = `${el.offsetLeft}px`;
            indicator.style.backgroundColor = el.getAttribute('active-color');

            el.classList.add('is-active');
            el.style.color = el.getAttribute('active-color');
        }
        items.forEach((item, index) => {
            item.addEventListener('click', (e) => { handleIndicator(e.target)});
            item.classList.contains('is-active') && handleIndicator(item);
        });
    </script>

@endpush
