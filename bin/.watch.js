const sass = require("sass");
const fs = require("fs");
const path = require("path");
const browserSync = require("browser-sync").create();

// Theme root as working directory
const cwd = path.resolve("../");

// Initialize BrowserSync
browserSync.init({
  proxy: "https://basicshit.test",
  cors: true,
  cwd: cwd,
  logLevel: `warn`,
  minify: false,
  open: "local",
  ui: false,
  reloadOnRestart: true,
  notify: false,
  files: ["dist/*.css", "views/*.twig", "lib/*.php", "*.php"],
});

// Reload JS
browserSync.watch("static/js/*.js", (event, file) => {
  if (event !== "change") return;

  const start = performance.now();
  try {
    browserSync.reload("*.js");
    const end = performance.now();
    const timer = Math.round(end - start, 3);
    console.log(`JS re-injected successfully in ${timer}ms`);
  } catch (error) {
    console.log("Error compiling JS:", error);
  }
});

// Compile *.scss to *.css
browserSync.watch("static/css/*.scss", (event, file) => {
  if (event !== "change") return;

  const start = performance.now();
  try {
    const result = sass.compile("static/css/theme.scss", {
      style: "compressed",
      sourceMap: true,
      logger: {
        warn(message, options) {
          if (message.includes(`deprecated`)) return;
          console.log(message);
        },
      },
    });
    fs.writeFileSync("static/dist/theme.css", result.css);
    browserSync.reload("*.css");
    const end = performance.now();
    console.log(`Sass compiled successfully in ${end - start}ms`);
  } catch (error) {
    console.log("Error compiling Sass:", error);
  }
});
