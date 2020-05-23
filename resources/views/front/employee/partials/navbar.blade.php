
<nav class="navbar navbar-expand-lg navbar-light ">
    <a class="navbar-brand" href="#"><img src="/public/img/logo.png" width="80px" height="40px"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <div class="navTrigger">
            <i></i><i></i><i></i>
        </div>
    </button>
    <div class="collapse navbar-collapse"  id="collapsibleNavbar">
        <ul class="navbar-nav"  >
            <li class="nav-item">
                <a  href="{{route('employee.home')}}" class="@if(request()->is('employee/home')) {{'active'}} @endif"> Home </a>
            </li>
            <li class="nav-item">
                <a  href="{{route('employee.requests')}}" class="@if(request()->is('employee/requests')) {{'active'}} @endif"> Requests </a>
            </li>
            <li class="nav-item">
                <a  href="{{route('employee.calendar')}}" class="@if(request()->is('employee/calendar')) {{'active'}} @endif"> Calendar </a>
            </li>
{{--            <li class="nav-item">--}}
{{--                <a  href="{{route('employee.chat')}}" class="@if(request()->is('employee/chat')) {{'active'}} @endif"> Chat </a>--}}
{{--            </li>--}}
            <li class="nav-item">
                <a  href="{{route('employee.post.index')}}" class="@if(request()->is('employee/post*')) {{'active'}} @endif"> Posts </a>
            </li>
            <li class="nav-item">
                <a  href="{{route('employee.reviews')}}" class="@if(request()->is('employee/reviews')) {{'active'}} @endif"> Reviews</a>
            </li>
            <li class="nav-item">
                <a  href="{{route('employee.profile')}}" class="@if(request()->is('employee/profile*')) {{'active'}} @endif"> Profile </a>
            </li>
            <li class="nav-item">
                <a  href="{{route('client.home')}}"> Switch </a>
            </li>
            <li class="nav-item">
                <a  href="#" onclick="document.getElementById('logout-form').submit()" > Logout </a>
            </li>
        </ul>
    </div>
</nav>
</ul>
<form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none;">
    @csrf
</form>

@push('js')
    <script>
        $('.navTrigger').on( "click",function(){
            $(this).toggleClass('active');
        });
    </script>
@endpush
