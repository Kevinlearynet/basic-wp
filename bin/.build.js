require("dotenv").config();

const sass = require("sass");
const fs = require("fs");
const path = require("path");
const distDir = path.resolve(`static/dist`);
const { generateImportmap, scssToCSS } = require(`./.utils`);
const start = performance.now();

// Generate  importmap's for JS modules
generateImportmap();

// SCSS to CSS
try {
  // Ensure the output directory exists
  if (!fs.existsSync(distDir)) {
    fs.mkdirSync(distDir, { recursive: true });
  }

  // Compile SASS
  scssToCSS();

  const end = performance.now();
  const runtime = (end - start).toFixed(3);
  console.log(`Production build successfully run in ${runtime}ms`);
} catch (error) {
  console.error("Error processing SCSS files:", error);
}
