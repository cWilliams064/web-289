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
          <li><a href="#">Recipes</a></li>
          <li><a href="about.html">About Us</a></li>
          <li><a href="#" id="sidebar-opener">Log In</a></li>
          <li><a href="#"><img src="assets/login-image.png" width="27" height="27" alt="User icon that links to login."></a></li>
        </ul>
      </nav>
      <section>
        <input type="text" placeholder="Search a recipe">
        <img src="assets/icons/search.svg" width="64" height="64" alt="Magnifying glass search icon.">
      </section>
      <img src="assets/logo.png" width="500" height="500" alt="Pink and navy cupcake logo for Grandma's Pantry.">
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
      <main role="main" id="home-page">
        <section>
          <section>
            <h1>Grandma's Pantry</h1>
            <p>We inspire flavor, you create magic!</p>
            <a href="recipes/index.php">View Our Recipes</a>
          </section>
          <img src="assets/h1-image.png" width="1084" height="427" alt="Picnic foods with a juice pitcher on top of a wooden counter in a kitchen with the sun shining in.">
        </section>
        <section id="popular-categories">
          <h2>Popular Categories</h2>
          <section>
            <a href="#"><h3>Breakfast</h3></a>
            <img src="assets/home-category/breakfast-category.png" width="322" height="395" alt="An egg croissant layered breakfast meal.">
          </section>
          <section>
            <a href="#"><h3>Vegan</h3></a>
            <img src="assets/home-category/vegan-category.png" width="322" height="395" alt="Vegan meal with avocado slices and egg on whole wheat bread.">
          </section>
          <section>
            <a href="#"><h3>Italian</h3></a>
            <img src="assets/home-category/italian-category.png" width="322" height="395" alt="Italian pasta with spaghetti noodles with tomatoes and herbs.">
          </section>
        </section>
        <section>
          <article>
            <h2>The Heart of Grandma's Pantry</h2>
            <p>Welcome to Grandma's Pantry, where every recipe is more than just a list of ingredients—it's a story waiting to be told. Inspired by the warmth and tradition of family kitchens, our mission is to empower cooks of all levels to create meals that bring people together.</p>
            <p>Whether you're exploring cherished classics or experimenting with new flavors, Grandma's Pantry is here to guide you every step of the way. Dive into our collection, share the joy of cooking, and start crafting memories one recipe at a time. Your culinary adventure begins here!</p>
          </article>
          <img src="assets/pancake-skillet.png" width="478" height="615" alt="A black skillet with pancakes and mixed berries.">
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
