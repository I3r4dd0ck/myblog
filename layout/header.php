<header>
    <a href="" class="logo">Blog<span>Quy</span></a>

    <ul class="navbar">
        <li><a href="#home">Home</a></li>
        <li><a href="#about">About Me</a></li>
        <li><a href="#contact">Liên hệ</a></li>
    </ul>
    <div class="top-btn">
        <?php if (isset($_COOKIE['username']) && !empty($_COOKIE['username'])): ?>
            <a href="?page=user&action=signout">Thoát đăng nhập</a>
        <?php else: ?>
            <a href="?page=user&action=signin">Đăng Nhập</a>
        <?php endif; ?>
    </div>

</header>