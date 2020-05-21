<nav class="nav">
    <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="fa fa-bars" aria-hidden="true"></i></a>
    <a href="{{route('client.home')}}" class="nav-item @if (  request()->is('client/home*'))) {{'is-active'}} @endif" active-color="green">Home</a>
    <a href="{{route('client.service')}}"  class="nav-item @if ( request()->is('client/services*')) {{'is-active'}} @endif" active-color="orange">Services</a>
    <a href="{{route('client.request.index')}}" class="nav-item  @if ( request()->is('client/request*')) {{'is-active'}} @endif " active-color="blue">Requests</a>
    <a href="{{route('client.invoice.index')}}" class="nav-item @if ( request()->is('client/invoice*')) {{'is-active'}} @endif" active-color="red"> Invoices </a>
    <a href="{{route('client.reviews.index')}}" class="nav-item @if ( request()->is('client/reviews*')) {{'is-active'}} @endif" active-color="purple"> Reviews </a>
    <a href="{{route('client.profile')}}" class="nav-item @if ( request()->is('client/profile*')) {{'is-active'}} @endif" active-color="green">Profile</a>
    <span class="nav-indicator"></span>
    <a href="" class="nav-item" > logout</a>
</nav>
<ul id="slide-out" class="sidenav">
    <li><div class="user-view">
            <div class="background">
                <img src="">
            </div>
            <a href="#user"><img class="circle" src=""></a>
            <a href="#name"><span class="black-text name">nnnn</span></a>
            <a href="#email"><span class="black-text email">nnn@gmail.com</span></a>
        </div></li>
    <li><a href="#!"><i class="material-icons">cloud</i>First Link With Icon</a></li>
    <li><a href="#!">Second Link</a></li>
    <li><div class="divider"></div></li>
    <li><a class="subheader">Subheader</a></li>
    <li><a class="waves-effect" href="#!">Third Link With Waves</a></li>
</ul>
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
    <script>
        $(document).ready(function(){
            $('.sidenav').sidenav();
        });


    </script>
@endpush
