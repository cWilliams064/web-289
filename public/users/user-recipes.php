<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Grandma's Pantry</title>
    <link href=favicon.ico rel="icon">
    <link href="css/styles.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>

  <body>
    <header role="banner">
      <nav>
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="recipes/index.php">Recipes</a></li>
          <li><a href="about.html">About Us</a></li>
          <li><a href="#" id="sidebar-opener">Log In</a></li>
          <li><a href="#"><img src="assets/login-image.png" width="27" height="27" alt="User icon that links to login."></a></li>
        </ul>
      </nav>
      <section>
        <input type="text" placeholder="Search.."><br>
        <img src="assets/icons/search.svg" width="64" height="64" alt="Magnifying glass search icon.">
      </section>
      <img src="assets/logo.png" width="500" height="500" alt="">
    </header>
    <div id="sidebar">
        <span id="closeSidebar">&times;</span>
        <h2>Login</h2>
        <form>
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" required><br>

            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required><br>
            
            <button type="submit">Login</button>
        </form>
        <a href="sign-up.php">Sign Up</a>
    </div>
    <div id="overlay"></div>
    <div id="wrapper">
      <main role="main">
        <h1>Your Recipes</h1>

        <h2>Saved Recipes</h2>
        <section>
            
        </section>

        <h2>Created Recipes</h2>
        <section>

        </section>
      </main>
    </div>
    <footer>
        <p>&copy; 2025 Grandma's Pantry. All Rights Reserved.</p>
        <nav>
          <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="recipes/index.php">Recipes</a></li>
            <li><a href="about.html">About Us</a></li>
          </ul>
        </nav>
        <section>
          <img src="assets/icons/instagram.png" width="31" height="31" alt="The social media Instagram logo.">
          <img src="assets/icons/x.png" width="31" height="31" alt="The social media X logo">
          <img src="assets/icons/facebook.png" width="31" height="31" alt="The social media Facebook logo.">
        </section>
    </footer>
  </body>

</html>
