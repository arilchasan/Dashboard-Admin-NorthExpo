<style>
    .foto {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        margin-left: 50px;
        margin-top: 20px;
    }

    .underline {
        width: 100%;
        /* margin-bottom: 20px;  */
        display: flex;
        justify-content: center;
    }

    .underline .line {
        width: 180px;
        height: 1px;
        background-color: #000000;
    }

    /* Google Fonts - Poppins */
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap");

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        /* font-family: 'Poppins' , 'sans-serif' */
    }

    nav .logo {
        display: flex;
        align-items: center;
        margin: 0 24px;
    }

    .logo .menu-icon {
        color: #333;
        font-size: 24px;
        margin-right: 14px;
        cursor: pointer;
    }

    .logo .logo-name {
        color: #333;
        font-size: 22px;
        font-weight: 500;
    }

    .sidebar .sidebar-content {
        display: flex;
        height: 100%;
        flex-direction: column;
        justify-content: space-between;
        padding: 30px 16px;
    }

    .sidebar-content .list {
        list-style: none;
    }

    .list .nav-link {
        display: flex;
        align-items: center;
        margin: 8px 0;
        padding: 14px 12px;
        border-radius: 8px;
        text-decoration: none;
    }

    .lists .nav-link:hover {
        background-color: #002c4f;
        color: #fff
    }

    .nav-link .icon {
        margin-right: 14px;
        font-size: 24px;
        color: #707070;
    }

    .nav-link .link {
        font-size: 16px;
        color: #707070;
        font-weight: 400;
    }

    .lists .nav-link:hover .icon,
    .lists .nav-link:hover .link {
        color: #fff;
    }

    .overlay {
        position: fixed;
        top: 0;
        left: -100%;
        height: 1000vh;
        width: 200%;
        opacity: 0;
        pointer-events: none;
        transition: all 0.4s ease;
        background: rgba(0, 0, 0, 0.3);
    }

    .bottom-cotent {
        margin-top: 50px;
    }
    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        background-color: #ffffff;
        box-shadow: 0 0 50px rgba(0, 0, 0, 0.1); 
        /* border-radius: 0;  */
    }
</style>


<div class="sidebar">

    <div class="menu">
        <a href=""><img src="{{ URL::to('assets/img/logo-dark.png') }}" class="foto"></a>
    </div>
    <div class="underline">
        <div class="line"></div>
    </div>
    <div class="sidebar-content">
        <ul class="lists">
            <li class="list">
                <a href="/dashboard/page" class="nav-link">
                    <i class="la la-dashboard icon"></i>
                    <span class="link">Dashboard</span>
                </a>
            </li>
            <li class="list">
                <a href="/dashboard/destinasi/all" class="nav-link">
                    <i class="la la-bar-chart icon"></i>
                    <span class="link">Destinasi</span>
                </a>
            </li>
            <li class="list">
                <a href="/dashboard/kuliner/all" class="nav-link">
                    <i class="la la-cutlery icon"></i>
                    <span class="link">Kuliner</span>
                </a>
            </li>
            <li class="list">
                <a href="/dashboard/userlogin/all" class="nav-link">
                    <i class="la la-user icon"></i>
                    <span class="link">User Login</span>
                </a>
            </li>
            <li class="list">
                <a href="/dashboard/order/list" class="nav-link">
                    <i class="las la-archive icon"></i>
                    <span class="link">Data Transaksi</span>
                </a>
            </li>
            <li class="list">
                <a href="/dashboard/order/transaksiAdmin" class="nav-link">
                    <i class="las la-exchange-alt icon"></i>
                    <span class="link">Transaksi Admin</span>
                </a>
            </li>

            <div class="bottom-cotent">
                <li class="list">
                    <a  class="nav-link">
                        
                        <span class="link">Hi, {{ auth('role_admins')->user()->username }}</span>
                    </a>
                </li>
                <li class="list">
                    <a href="{{ route('logoutAdmin') }}" class="nav-link">
                        <i class="las la-sign-out-alt icon"></i>
                        <span class="link">Logout</span>
                    </a>
                </li>
            </div>
            
        </ul>
    </div>
</div>

<script>
    const navBar = document.querySelector("nav"),
        menuBtns = document.querySelectorAll(".menu-icon"),
        overlay = document.querySelector(".overlay");

    menuBtns.forEach((menuBtn) => {
        menuBtn.addEventListener("click", () => {
            navBar.classList.toggle("open");
        });
    });

    overlay.addEventListener("click", () => {
        navBar.classList.remove("open");
    });
    
</script>
