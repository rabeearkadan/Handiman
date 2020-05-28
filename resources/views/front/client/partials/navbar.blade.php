<nav class="nav">
    <a href="#" data-target="slide-out" class="nav-item sidenav-trigger" ><i class="fa fa-bars">menu</i></a>
    <a href="{{route('client.home')}}" class="nav-item @if (  request()->is('client/home*')) {{'is-active'}} @endif" active-color="green">Home</a>
    <a href="{{route('client.service')}}"  class="nav-item @if ( request()->is('client/services*')) {{'is-active'}} @endif" active-color="orange">Services</a>
    <a href="{{route('client.request.index')}}" class="nav-item  @if ( request()->is('client/request*')) {{'is-active'}} @endif " active-color="blue">Requests</a>
    <span class="nav-indicator"></span>
</nav>
<ul id="slide-out" class="sidenav">
    <li><div class="user-view">
            <div class="background">
                <img src="/public/images/client/sidenav-background.png" style="width:300px; height:176px; border-radius: 0">
            </div>
            <a href="#user"><img class="circle" src="@if(Auth::user()->image){{config('image.path').Auth::user()->image}}@else /public/images/employee/profile-image.png @endif" alt="User"></a>
            <a href="#name"><span class="black-text name">{{ Auth::user()->name }}</span></a>
            <a href="#email"><span class="black-text email">{{ Auth::user()->email }}</span></a>
        </div></li>

    <li><a class="waves-effect" href="{{route('client.profile')}}">Profile</a></li>
    <li><a class="waves-effect" href="{{route('client.invoice.index')}}">Bills</a></li>
    <li><a class="waves-effect" href="{{route('client.reviews.index')}}">Reviews</a></li>
    <li><a class="waves-effect" href="{{route('employee.home')}}">Switch</a></li>
    <li><a class="waves-effect" href="#" onclick="document.getElementById('logout-form').submit()">Logout</a></li>
</ul>
<form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none;">
    @csrf
</form>

@push('js')
    <script>
        const indicator = document.querySelector('.nav-indicator');
        const items = document.querySelectorAll('.nav-item');
        function handleIndicator(el) {


            el.classList.add('is-active');
            el.style.color = el.getAttribute('active-color');
        }
        items.forEach((item, index) => {
            item.addEventListener('click', (e) => { handleIndicator(e.target)});
            item.classList.contains('is-active') && handleIndicator(item);
        });
    </script>
    <script src="/public/js/materialize.js"></script>
    <script>
        $(document).ready(function(){
            $('.sidenav').sidenav();
        });
    </script>
@endpush
