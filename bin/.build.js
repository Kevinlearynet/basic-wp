const sass = require("sass");
const fs = require("fs");
const path = require("path");
const cwd = path.resolve("../");
const scssDir = path.resolve("static/css");
const distDir = path.resolve("static/dist");
const start = performance.now();

process.chdir(cwd);

try {
  // Ensure the output directory exists
  if (!fs.existsSync(distDir)) {
    fs.mkdirSync(distDir, { recursive: true });
  }

  // Read all /static/css/*.scss files, ignoring any beginning with _
  const scssFiles = fs.readdirSync(scssDir).filter((file) => file.endsWith(".scss") && !file.startsWith("_"));

  scssFiles.forEach((scssFile) => {
    const inputFile = path.join(scssDir, scssFile);
    const outputFile = path.join(distDir, scssFile.replace(".scss", ".css"));

    try {
      const result = sass.compile(inputFile, {
        style: "compressed",
        sourceMap: true,
        logger: {
          warn(message, options) {
            if (message.includes(`deprecated`)) return;
            console.log(message);
          },
        },
      });

      fs.writeFileSync(outputFile, result.css);
      const file = path.basename(outputFile);
      console.log(`Sass compiled successfully: ${file}`);
    } catch (error) {
      const file = path.basename(scssFile);
      console.error(`Error compiling Sass for ${file}:`, error);
    }
  });

  const end = performance.now();
  const timer = Math.round(end - start, 3);
  console.log(`Production build successfully run in ${timer}ms`);
} catch (error) {
  console.error("Error processing SCSS files:", error);
}
