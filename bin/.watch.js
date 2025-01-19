require("dotenv").config();

const fs = require("fs");
const path = require("path");
const browserSync = require("browser-sync").create();
const { generateImportmap, scssToCSS } = require(`./.utils`);

// Theme root as working directory
const cwd = path.resolve("../");

// Initialize BrowserSync
browserSync.init({
  proxy: process.env.LOCALHOST_URL,
  cors: true,
  cwd: cwd,
  logLevel: `warn`,
  minify: false,
  open: false,
  ui: false,
  ghostMode: false,
  reloadOnRestart: true,
  notify: false,
  cors: true,
  files: ["dist/*.css", "views/*.twig", "lib/*.php", "*.php"],
});

// Generate  importmap's for JS modules
browserSync.watch("package-lock.json", (event, file) => {
  if (event !== "change") return;

  generateImportmap();
  browserSync.reload("*.js");
});

// Reload JS during development
browserSync.watch("static/js/*.js", (event, file) => {
  if (event !== "change") return;

  const start = performance.now();
  try {
    browserSync.reload("*.js");
    const end = performance.now();
    const runtime = (end - start).toFixed(3);
    console.log(`JS re-injected successfully in ${runtime}ms`);
  } catch (error) {
    console.log("Error compiling JS:", error);
  }
});

// Compile *.scss to *.css
browserSync.watch("static/css/*.scss", (event, file) => {
  if (event !== "change") return;
  scssToCSS();
  browserSync.reload("*.js");
});
