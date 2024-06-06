<nav class="NavbarItems">
    <h1 class="Navbar-logo">JourneyHub</h1>
    <div class="menu-icons" onclick="toggleMenu()">
        <i class="fas fa-bars"></i>
    </div>
    <ul class="nav-menu" id="nav-menu">
        @foreach (config('menu_items') as $index => $item)
            <li>
                <a class="{{ $item['cName'] }}" href="{{ $item['url'] }}">
                    @if(isset($item['icon']))
                        <i class="{{ $item['icon'] }}"></i>
                    @endif
                    {{ $item['title'] }}
                </a>
            </li>
        @endforeach
        <li>
            <a href="{{ route('login') }}">
                <button>Log In</button>
            </a>
        </li>
    </ul>
</nav>



<style>
    .NavbarItems{
    background-color: #fff;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 30px;
    box-shadow: 0 5px 15px  0 rgba(0,0,0,.25);
    width: 95%;
    height: 80px;
    border-radius: 13px;
    position: fixed;
    top:20px;
    left: 50%;
    transform: translate(-50%);
    z-index: 9999;
}
.Navbar-logo{
    color:#222;
    font-size: 2rem;
    cursor: pointer;
}
.nav-menu{
    display: grid;
    grid-template-columns: repeat(6,auto);
    grid-gap: 10px;
    list-style: none;
    align-items: center;
}
.nav-links{
    text-decoration: none;
    color:#222;
    font-size: 1.2rem;
    font-weight: 600;
    padding: 0.7rem 1rem ;
    white-space: nowrap;
}
.nav-links i{
    padding-right: 10px;

}
.nav-links:hover{
    background-color: #019;
    color: #fff;
    border-radius:4px;
    transition: all 0.2s ease-in-out;
}
.nav-links-mobile{
    display: none;
}
.nav-menu button{
    padding: 0.5rem 1rem;
    white-space: nowrap;
    border: solid;
    border-radius: 0.3rem;
    font-size: 1.2rem;
    font-weight: 600;
    border: none;
    cursor: pointer;
    transition: 0.2s ease-in-out;
}
.nav-menu button:hover{
    background-color: #019;
    color:#fff
}
.menu-icons{
    display: none;
}

@media screen and (max-width: 850px){
    .NavbarItems{
        z-index: 99;
    }
    
    .nav-menu{
        display: flex;
        text-align: center;
        flex-direction: column;
        justify-content: flex-start;
        background: white;
        width: 100%;
        height: auto;
        position: absolute;
        top: 0;
        left: -100%;
        opacity: 0;
        align-items: stretch;
        padding: 80px 0 30px 0;
        margin: 0;
        transition: 0.3s ease-in-out;
        border-radius: 13px;
    }
    .nav-menu.active{
        left: 0;
        opacity: 1;
        z-index: -1;
        transition: 0.3s ease-in-out;
    }

    .nav-links{
        display: block;
        width: 100%;
        font-size: 1.2rem;
        padding: 2rem 0;
    }
    .nav-links:hover{
        background: #019;
        transition: none;
    }
    button{
        display: none;
    }
    .nav-links-mobile{
        display: block;
        text-align: center;
        padding: 1.5rem;
        margin: auto;
        border-radius: 4px;
        width: 80%;
        background: #019;
        text-decoration: none;
        color:white;
        font-size: 1.2rem;
        font-weight: 700;
        letter-spacing: 2px;
    }

    .menu-icons{
        display: block;
        cursor: pointer;
    }
    .menu-icons i{
        font-size: 1.2rem;
        color: #222;
    }
}
</style>

<script>
    function toggleMenu() {
        const menu = document.getElementById('nav-menu');
        menu.classList.toggle('active');

        const icon = document.querySelector('.menu-icons i');
        icon.classList.toggle('fa-bars');
        icon.classList.toggle('fa-times');
    }
</script>