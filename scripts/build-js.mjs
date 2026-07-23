// Concatenates the theme's front-end JS files (in load order, matching the
// dependency order previously enforced by wp_enqueue_script) into a single
// minified bundle, so the browser makes one request instead of six.
import { readFileSync, writeFileSync } from "node:fs";
import { fileURLToPath } from "node:url";
import path from "node:path";
import * as esbuild from "esbuild";

const themeJsDir = path.resolve(
  path.dirname(fileURLToPath(import.meta.url)),
  "../wp-content/themes/alisonsacupuncture/assets/js"
);

const files = [
  "animations.js",
  "hero-parallax.js",
  "about-parallax.js",
  "contact-appointment.js",
  "mobile-nav.js",
  "office-directions.js",
];

const combined = files
  .map((file) => readFileSync(path.join(themeJsDir, file), "utf8"))
  .join("\n;\n");

const result = await esbuild.transform(combined, { minify: true, loader: "js" });

writeFileSync(path.join(themeJsDir, "bundle.min.js"), result.code);
console.log(`Built bundle.min.js from ${files.length} files`);
