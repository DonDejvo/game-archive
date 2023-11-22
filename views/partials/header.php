<header>
  <h1>Game Archive</h1>
  <ul>
    <li>
      <a href="index.php">Home</a>
    </li>
    <li>
      <a href="games.php">Games</a>
    </li>
    <?php if($controller->getUser() == null): ?>
    <li>
      <a href="login.php">Login</a>
    </li>
    <li>
      <a href="register.php">Register</a>
    </li>
    <?php else: ?>
    <li>
      <a href="profile.php">Profile</a>
    </li>
    <li>
      <a href="logout.php">Logout</a>
    </li>
    <?php endif; ?>
  </ul>
</header>