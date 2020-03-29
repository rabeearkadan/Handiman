<nav class="nav">
    <a href="{{route('client.home')}}" class="nav-item @if (  request()->is('client/home*'))) {{'is-active'}} @endif" active-color="green">Home</a>
    <a href="{{route('client.service')}}"  class="nav-item @if ( request()->is('client/services*')) {{'is-active'}} @endif" active-color="orange">Services</a>
    <a href="{{route('client.request.index')}}" class="nav-item  @if ( request()->is('client/requests*')) {{'is-active'}} @endif " active-color="blue">Requests</a>
    <a href="{{route('client.invoice.index')}}" class="nav-item @if ( request()->is('client/invoice*')) {{'is-active'}} @endif" active-color="red"> Invoices </a>
    <a href="{{route('client.reviews.index')}}" class="nav-item @if ( request()->is('client/reviews*')) {{'is-active'}} @endif" active-color="purple"> Reviews </a>
    <a href="{{route('client.profile')}}" class="nav-item @if ( request()->is('client/profile*')) {{'is-active'}} @endif" active-color="green">Profile</a>
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
