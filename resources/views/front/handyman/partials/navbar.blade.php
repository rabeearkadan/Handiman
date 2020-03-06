
<nav class="navbar navbar-expand-lg navbar-light ">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <div class="navTrigger">
            <i></i><i></i><i></i>
        </div>
    </button>
    <div class="collapse navbar-collapse"  id="collapsibleNavbar">
        <ul class="navbar-nav"  >
            <li class="nav-item">
                <a  href="#" class=""> Home </a>
            </li>
            <li class="nav-item">
                <a  href="#" class=""> Requests </a>
            </li>
            <li class="nav-item">
                <a  href="#" class=""> Jobs </a>
            </li>
            <li class="nav-item">
                <a  href="#" class=""> Messages </a>
            </li>
            <li class="nav-item">
                <a  href="#" class=""> Reviews</a>
            </li>
            <li class="nav-item">
                <a  href="#" class=""> Profile </a>
            </li>
        </ul>
    </div>
</nav>


@push('js')
    <script>
        $('.navTrigger').click(function(){
            $(this).toggleClass('active');
        });
    </script>
@endpush
