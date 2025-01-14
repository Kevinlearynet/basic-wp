# Minimal WordPress Theme

Starting point for building custom WordPress themes that are lean and minimal, which has many advantages over working with a theme framework. It uses modern web development approaches and patterns, some of which are contrarian but have been proven to be highly effective in practice.

## Modern Features

- SASS + BEM pattern styling
- Native ES modules
- Composer package management
- Twig view templating
- View/controller pattern
- Namespaced PHP for isolation
- Built-in support for ACF:
- Global context variables for common WordPress data: `site_url`, `site_description`, `site_url`, `theme_dir`, `theme_url`, `primary_nav`, `acf`, `the_title()`, `the_content()`

View context is deliberately kept sparse, during a site build you'll add what you specifically need for a particular site. Having a lean context for your views will help with both performance and workflow.

## Install & Setup

After cloning the repository you'll need to install all `npm` and `composer` dependencies by running the following commands from the theme's root directory:

1. `npm i`
1. `composer install`

This will install JS modules for compiling static assets (JS and SCSS), and also the templating engine (Twig) for PHP.

### Environment (`.env`)

Make a copy of the `.env.example` file to create your own `.env` file, then set the `LOCALHOST_URL` to the URL for your localhost site. This allows you to work with whatever localhost system you prefer: WPEngine's [Local](https://wpengine.com/local/), Kinsta's [DevKinsta](https://kinsta.com/devkinsta/) or anything else better in the future.

### Build & Compile

The focus here is simplicity and developer speed over complexity, and the build certainly reflects this mentality.

### Watch

During development use `npm run watch` to work at `https://localhost:3000`. When you save Twig view templates, JavaScript files, PHP files, and \*.scss files the URL will be reloaded, either fully or with hot module replacement depending on what has changed.

`npm run watch`

**Saving changes to JavaScript and SASS/SCSS will typically compile and reload in the browser in under 100ms**

### Build

To do a production build run `npm run build` to compile all SCSS for production. JavaScript is **not** compiled, and WordPress will load theme JS as native ES modules using [WordPress 6.5's support for ES modules](https://www.kevinleary.net/blog/wordpress-asset-loading/). This approach could be enhanced with a dynamically generated `importmap.json`, which is something I may consider adding here in the future.

My reasoning for this is that many sites now pass through CloudFlare, so modern compression is handled for JS automatically. Many specialized WordPress hosts do this as well. When comparing minification to gzip it's clear that minification provides trivial gains in file reduction. The vast majority of file reduction is provided by CDN and server compression. Based on this I believe the benefits of a fast workflow far outweigh the additional overhead of pulling in build steps for Webpack, Rollup, or other similar packaging tools.

We're fortunate that the web fully supports ES modules today, so there is really no reason why we should need to compiles JavaScript at all if we're not using a JS framework like Vue, React or Svelte.

**Compiling with this build process takes less than 100ms**

## Views

While other frameworks like Roots Sage use Blade for templating, I've chosen to use Twig to power the core `<body>` area of the site, but **not** the header and footer. This avoid added complexity needed to handle WordPress hooks within a Twig layout, and also doesn't really cause any inconvenient or issue: all aspects of the website that will be coded as part of a template are included in views.

### Twig Engine

This theme uses Twig for view templates over other options for a few reasons:

- Oldest and most widely familiar to PHP developers
- Provides all needed functionality
- It's an established library that doesn't update or change much from here on out, so less likely to cause headaches in the future and more likely to **just work**
- Direct stacktraces are provided when errors occur, making it easy to identify syntax errors in view templates (something Blade or BladeOne do not do well)
- It's faster than Blade and BladeOne, and is very close to the same speed as raw PHP templating

I do like Blade quite a bit, but it's best suited for Laravel in my opinion. BladeOne does provide a good way to use it as a standalone templating engine, but even then it's still not as performant under pressure as Twig. Twig's added performance when used with small, efficient contexts allow us to avoid the complexity that comes with caching view output. Compile-on-the-fly Twig in this use case is very close to the same speed as raw PHP.

Also, the Twig syntax and Blade syntax aren't really all that different.

![PHP templating performance](https://miro.medium.com/v2/resize:fit:1400/format:webp/1*VzlJqAd9IUBXf6R_q1Uk0Q.jpeg)

## Controllers

Standard WordPress theme template files serve as controllers. This avoids added abstraction and overhead required to load templates from a theme's subdirectory, and also has the added benefit of being familiar to every single theme developer in the world.

## Composer

Composer is used to install Twig

## Structure

The theme uses the standard WordPress template hierarchy, something that **all** WordPress developers are (or should be) familiar with.

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
- `tag.php` - Displays a list of posts associated with a specific tag.
