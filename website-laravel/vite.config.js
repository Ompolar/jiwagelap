import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/sass/app.scss",
                "resources/js/app.js",
                "resources/js/my_app.js",
                "resources/js/youtube_channel.js",
            ],
            refresh: true,
        }),
    ],
});
