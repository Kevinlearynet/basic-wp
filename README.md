# Basic Custom WordPress Theme

Very basic custom WordPress theme, for learning purposes. This includes very little, but shows a general structure that's good to understand when you're creating your first custom theme.

This accompanies a blog post found on kevinleary.net: [Simplest Guide to Custom WordPress Themes](https://www.kevinleary.net/blog/simplest-guide-to-custom-wordpress-themes/)

## Structure

- `404.php` - Displays a custom "Page Not Found" message when a visitor tries to access a page that doesn't exist.
- `archive.php` - Displays a list of posts from a particular archive, such as a category, date, or tag archive.
- `author.php` - Displays a list of posts by a specific author, along with the author's information.
- `category.php` - Displays a list of posts from a specific category.
- `footer.php` - Contains the footer section of the theme, typically including closing HTML tags and widgets or navigation in the footer area.
- `front-page.php` - The template used for the front page of the site, either static or a blog, depending on the site settings.
- `functions.php` - Adds custom functionality to the theme, such as registering menus, widgets, or adding theme support for features like custom logos or post thumbnails.
- `header.php` - Contains the header section of the theme, typically including the site's title, meta tags, and navigation menu.
- `index.php` - The fallback template for all WordPress pages, used if no other more specific template (like `category.php` or `single.php`) is available.
- `page.php` - Displays individual static pages, such as "About" or "Contact" pages.
- `screenshot.png` - An image of the theme’s design, shown in the WordPress theme selector to give users a preview of the theme's appearance.
- `search.php` - Displays the results of a search query, showing posts or pages that match the search terms entered by the user.
- `single.php` - Displays individual posts, often used for blog posts or custom post types.
- `style.css` - The main stylesheet for the theme, used to style the visual elements of the site. It also contains the theme's metadata, such as the theme name and version, at the top.
- `tag.php` - Displays a list of posts associated with a specific tag.
- `theme.css` - A secondary or additional stylesheet for the theme, used to add more custom styles separate from `style.css`. This may not be included in every theme.
- `theme.js` - A JavaScript file for the theme, used to add custom interactivity, animations, or other frontend behaviors.
