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
  watch: true,
  cors: true,
});

// Generate  importmap's for JS modules
browserSync.watch("package-lock.json", (event, file) => {
  if (event !== "change") return;

  generateImportmap();
  browserSync.reload();
});

// Reload JS during development
browserSync.watch(`static/js/*.js`, (event, file) => {
  if (event !== "change") return;

  const start = performance.now();
  try {
    browserSync.stream();
    const end = performance.now();
    const runtime = (end - start).toFixed(3);
    console.log(`JS re-injected successfully in ${runtime}ms`);
  } catch (error) {
    console.log("Error compiling JS:", error);
  }
});

// Compile *.scss to *.css
browserSync.watch("static/scss/*.scss", (event, file) => {
  if (event !== "change") return;
  scssToCSS();
});

// Reload on *.php and *.twig changes
browserSync.watch(["views/**/*.twig", "./**/*.php"], (event, file) => {
  if (event !== "change") return;
  const base = path.basename(file);
  console.log(`Reloading entire page for change to ${base}`);
  browserSync.reload();
});
