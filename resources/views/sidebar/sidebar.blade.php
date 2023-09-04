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
        /* height: 100%; */
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

    .list .nav-link:hover {
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

    .list .nav-link:hover .icon,
    .list .nav-link:hover .link {
        color: #fff;
    }

    .bottom-cotent {
        margin-top: auto;

    }

    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        background-color: #ffffff;
        box-shadow: 0 0 50px rgba(0, 0, 0, 0.1);
        /* border-radius: 0;  */
    }

    .hamburger-menu {
        width: 24px;
        height: 24px;
        z-index: 1000;
        cursor: pointer;
        position: fixed;
        top: 20px;
        right: 30px;
        display: none;
    }

    .close-menu {
        width: 24px;
        height: 24px;
        z-index: 1000;
        cursor: pointer;
        position: fixed;
        top: 20px;
        right: 30px;
        display: none;
    }

    @media (max-width: 768px) {
        .hamburger-menu {
            display: block;
            position: fixed;
        }

        .sidebar.open {
            margin-left: 0;
            width: 250px;
        }

        .overlay {
            display: none;
            width: 100vw;
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.2);
            position: fixed;
            z-index: 999;
        }

        .overlay.open {
            display: block;
            opacity: 0;
            animation: fadeIn .5s ease-in-out forwards;
            backdrop-filter: blur(20px);
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

</style>

<div class="overlay" id="overlay"></div>
<div class="hamburger-menu" id="hamburger-menu">
    <img src="{{ URL::to('assets/img/icons/menu-outline.svg') }}" alt="" srcset="">
</div>

<div class="close-menu" id="close-menu">
    <img src="{{ URL::to('assets/img/icons/close-outline.svg') }}" alt="" srcset="">
</div>
<div class="sidebar">
    <div class="menu">
        <a href=""><img src="{{ URL::to('assets/img/logo-dark.png') }}" class="foto"></a>
    </div>
    <div class="underline">
        <div class="line"></div>
    </div>
    <div class="sidebar-content">
        @if(auth('role_admins')->user()->role == 'superadmin')
        <ul class="list">
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
            @endif

            @if(auth('role_admins')->user()->role == 'penjaga' || auth('role_admins')->user()->role == 'superadmin')
            <li class="list">
                <a href="/dashboard/order/datatrs" class="nav-link">
                    <i class="las la-archive icon"></i>
                    <span class="link">Data Transaksi</span>
                </a>
            </li>
            <li class="list">
                <a href="/dashboard/scan" class="nav-link">
                    <i class="las la-qrcode icon"></i>
                    <span class="link">Scan</span>
                </a>
            </li>
            @endif

            <div class="bottom-cotent">
                <li class="list">
                    <a class="nav-link">
                        <span class="link">Hai, {{ auth('role_admins')->user()->username }}</span>
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
    const greeting = document.getElementById("greeting");
    const username = "{{ auth('role_admins')->user()->username }}";
    const currentTime = new Date().getHours();

    if (currentTime >= 0 && currentTime < 12) {
        greeting.textContent = `Selamat Pagi, ${username}`;
    } else if (currentTime >= 12 && currentTime < 18) {
        greeting.textContent = `Selamat Siang, ${username}`;
    } else {
        greeting.textContent = `Selamat Malam, ${username}`;
    }
</script>


<script>
    // if .hamburger-menu clicked change .sidebar margin-left: 0;
    const hamburgerMenu = document.getElementById("hamburger-menu");
    const closeMenu = document.getElementById("close-menu");
    const sidebar = document.querySelector(".sidebar");
    const overlay = document.getElementById("overlay");
    
    hamburgerMenu.addEventListener("click", () => {
        sidebar.classList.toggle("open");
        overlay.classList.toggle("open");
        hamburgerMenu.style.display = "none";
        closeMenu.style.display = "block";
    });

    closeMenu.addEventListener("click", () => {
        sidebar.classList.toggle("open");
        overlay.classList.toggle("open");
        hamburgerMenu.style.display = "block";
        closeMenu.style.display = "none";
    });
</script>