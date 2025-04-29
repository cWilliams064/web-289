<h1>👵 Grandma’s Pantry</h1>

Grandma’s Pantry is a capstone project built with JavaScript, PHP, HTML, and MySQL. This recipe-sharing platform allows users to share and discover recipes in a simple, no-fluff interface. Designed for both casual visitors and registered members, the site focuses on providing fast access to recipes without unnecessary long-winded descriptions.

<h2>📝 Overview</h2>

Tired of scrolling past someone’s childhood memories to get to a recipe? We were too. Grandma’s Pantry keeps it short—recipe descriptions are capped at 255 characters.

<h2>✨ Features & Technologies</h2>

JavaScript

Halve, double, triple, or reset ingredient quantities

Sort/filter recipes on the client side (with PHP fallback)

PHP

Backend processing for filtering, sorting, uploading images, and more

CSS

Print-friendly formatting for easy recipe printing

YouTube Embeds

Watch recipe walk-throughs directly on the recipe page

<h2>👥 User Roles & Capabilities</h2>

<h3>General Public -</h3>

Search, filter, and sort recipes by:

Type (breakfast, lunch, dinner, snack, dessert, etc.)

Style (Italian, Cuban, Thai, Fusion, N/A, etc.)

Diet (vegan, raw, whole food, vegetarian, gluten-free, sugar-free, etc.)

Newest

Highest rated

View embedded YouTube recipe walk-throughs

Adjust ingredient quantities with one click

Print recipes with clean, print-specific styles

<h3>Members -</h3>

Everything the general public can do, plus:

Rate recipes

Post their own recipes with:

255-character description

Tags for type, style, and diet

Unlimited ingredients with quantities

Unlimited step-by-step directions

Prep and cook times

Image uploads

YouTube video link (optional)

<h3>Admins -</h3>

All member features, plus:

Activate or deactivate users

Create and manage recipe categories:

Type (e.g., breakfast, dinner)

Style (e.g., Italian, Thai)

Diet (e.g., vegan, gluten-free)

<h3>Super Admins -</h3>
Everything Admins can do, plus:

Activate or deactivate Admin accounts

<h2>📸 Images & Media Sources</h2>

All images used on Grandma’s Pantry are copyright-free, sourced from reputable platforms offering royalty-free content. We ensure that all images are either public domain or properly licensed for use.

The YouTube videos embedded on the site are provided under Creative Commons licenses and are appropriately cited with the necessary attribution in compliance with the licensing requirements.

<h2>🛠️ Installation Instructions</h2>
To install Grandma’s Pantry locally, begin by cloning the repository to your computer using Git. Once the files are downloaded, locate the db-dump.sql file included in the project and import it into your MySQL server using your preferred tool, such as phpMyAdmin or the MySQL command line.

Next, create a new file named db-credentials.php inside a folder called private at the root of the project. Inside this file, define your database connection details, including the database server, username, password, and the name of the database you imported.

Finally, start a local server environment like MAMP, XAMPP, or similar, and point it to the root directory of the project. You can then open the site in your browser by navigating to index.php.

<h3>🧩 Database Schema</h3>
The Grandma’s Pantry database has been designed following principles of database normalization to reduce redundancy and ensure data integrity. Tables are structured to support a many-to-many relationship between recipes and categories such as meal type, ethnic style, and diet type through junction tables. This structure allows flexible filtering and scalable data organization.

You can view the full visual schema on [dbdiagram.io](https://dbdiagram.io/d/recipe_capstone_app-679073df37f5d6cbeb83a14a) for a complete overview of table relationships and fields.

For the sql dump check the files above in the resources folder!
