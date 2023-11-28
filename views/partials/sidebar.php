<div id="sidebar" class="sidebar">
    <div class="sidebar-container">
        <ul class="sidebar-nav">
            <li class="sidebar-nav__item">
                <a href="index.php" class="sidebar-nav__item__link">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5.432l8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 01-.75-.75v-4.5a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75V21a.75.75 0 01-.75.75H5.625a1.875 1.875 0 01-1.875-1.875v-6.198a2.29 2.29 0 00.091-.086L12 5.43z"></path></svg>
                    Home
                </a>
            </li>
            <li class="sidebar-nav__item">
                <a href="games.php" class="sidebar-nav__item__link">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006"></path></svg>
                    Games
                </a>
            </li>
        </ul>
        <hr class="sidebar-separator" />
        <ul class="sidebar-nav">
            <?php if($controller->getUser() != null): ?>
            <li class="sidebar-nav__item">
                <a href="profile.php" class="sidebar-nav__item__link">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path></svg>
                    Profile
                </a>
            </li>
            <li class="sidebar-nav__item">
                <a href="logout.php" class="sidebar-nav__item__link">
                <svg fill="currentColor" height="64px" width="64px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 471.2 471.2" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <path d="M227.619,444.2h-122.9c-33.4,0-60.5-27.2-60.5-60.5V87.5c0-33.4,27.2-60.5,60.5-60.5h124.9c7.5,0,13.5-6,13.5-13.5 s-6-13.5-13.5-13.5h-124.9c-48.3,0-87.5,39.3-87.5,87.5v296.2c0,48.3,39.3,87.5,87.5,87.5h122.9c7.5,0,13.5-6,13.5-13.5 S235.019,444.2,227.619,444.2z"></path> <path d="M450.019,226.1l-85.8-85.8c-5.3-5.3-13.8-5.3-19.1,0c-5.3,5.3-5.3,13.8,0,19.1l62.8,62.8h-273.9c-7.5,0-13.5,6-13.5,13.5 s6,13.5,13.5,13.5h273.9l-62.8,62.8c-5.3,5.3-5.3,13.8,0,19.1c2.6,2.6,6.1,4,9.5,4s6.9-1.3,9.5-4l85.8-85.8 C455.319,239.9,455.319,231.3,450.019,226.1z"></path> </g> </g> </g></svg>
                    Logout
                </a>
            </li>
            <?php else: ?>
            <li class="sidebar-nav__item">
                <a href="login.php" class="sidebar-nav__item__link">
                    Login
                </a>
            </li>
            <li class="sidebar-nav__item">
                <a href="register.php" class="sidebar-nav__item__link">
                    Register
                </a>
            </li>
            <?php endif; ?>
        </ul>
        <hr class="sidebar-separator" />
        <ul class="sidebar-nav">
            <li class="sidebar-nav__item">
                <a class="sidebar-nav__item__link" href="https://github.com/DonDejvo/game-archive">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.88,0.6C5.5,0.6,0.3,5.8,0.3,12.18c0,5.44,3.78,10.05,8.86,11.23c0-0.12-0.12-0.35-0.12-0.59V20.8c-0.47,0-1.3,0-1.42,0c-0.83,0-1.54-0.35-1.89-0.95c-0.35-0.71-0.47-1.77-1.42-2.48C4.08,17.14,4.2,16.9,4.55,16.9c0.59,0.12,1.06,0.59,1.54,1.18c0.47,0.59,0.71,0.71,1.54,0.71c0.47,0,1.06,0,1.65-0.12c0.35-0.83,0.83-1.54,1.54-1.89c-3.9-0.35-5.67-2.36-5.67-4.96c0-1.18,0.47-2.25,1.3-3.19c-0.35-0.59-0.71-2.48,0-3.19c1.77,0,2.84,1.18,3.07,1.42c0.83-0.35,1.77-0.47,2.84-0.47s2.01,0.12,2.84,0.47c0.24-0.35,1.3-1.42,3.07-1.42c0.71,0.71,0.35,2.6,0.12,3.55c0.83,0.95,1.3,2.01,1.3,3.07c0,2.6-1.89,4.49-5.67,4.96c1.06,0.59,1.89,2.13,1.89,3.31v2.6c0,0.12,0,0.12,0,0.24c4.49-1.54,7.8-5.91,7.8-10.99C23.46,5.8,18.26,0.6,11.88,0.6z"></path></svg>
                    Github
                </a>
            </li>
            <li class="sidebar-nav__item">
                <a class="sidebar-nav__item__link" href="mailto:dolejdav@fel.cvut.cz">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.35,3.18c-0.95,0-1.79,0.83-1.79,1.79v14.06c0,0.95,0.83,1.79,1.79,1.79h19.31c0.95,0,1.79-0.83,1.79-1.79V4.97c0-0.95-0.83-1.79-1.79-1.79h1.07H2.35z M4.73,4.97h14.54L12,10.33L4.73,4.97z M3.18,7.11L12,13.55l8.82-6.44v11.92H3.18V7.11z"></path></svg>
                    Email
                </a>
            </li>
        </ul>
    </div>
</div>
<script src="js/sidebar.js"></script>