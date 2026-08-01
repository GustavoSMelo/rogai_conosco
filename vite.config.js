import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
  plugins: [
    laravel({
      input: [
        "resources/css/app.css",
        "resources/css/welcome.css",
        "resources/css/painel.css",
        "resources/css/result.css",
        "resources/css/donate.css",
        "resources/js/welcome.ts",
        "resources/js/donate.ts",
      ],
      publicDirectory: "public",
      assetsDirectory: "public",
      refresh: true,
    }),
  ],
});