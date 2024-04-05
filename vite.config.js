import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                // CSS
                "resources/css/abilities.css",
                "resources/css/checkmark.css",
                "resources/css/default-colors.css",
                "resources/css/entreprise_localisations.css",
                "resources/css/footer.css",
                "resources/css/general.css",
                "resources/css/login.css",
                "resources/css/offer.css",
                "resources/css/pagination.css",
                "resources/css/profile.css",
                "resources/css/reset.css",
                "resources/css/star_rate.css",
                "resources/css/welcome.css",
                // JS
                "resources/js/abilities/champ_obligatoire.js",
                "resources/js/auth/champ_obligatoire.js",
                "resources/js/companies/champ_obligatoire.js",
                "resources/js/companies/stats.js",
                "resources/js/promotions/champ_obligatoire.js",
                "resources/js/users/champ_obligatoire.js",
                "resources/js/edit_offer_abilities.js",
                "resources/js/edit_offer_localization.js",
                "resources/js/entreprise_localisations.js",
                "resources/js/entreprise_search.js",
                "resources/js/entreprise_validation.js",
                "resources/js/file.js",
                "resources/js/geoapigouv.js",
                "resources/js/offer_filter.js",
                "resources/js/offer_localization.js", // Notez l'espace dans le nom de fichier, assurez-vous qu'il est correctement écrit
                "resources/js/offer.js",
                "resources/js/offers_stats.js",
                "resources/js/pagination.js",
                "resources/js/pending.js",
                "resources/js/promotion_ability.js",
                "resources/js/star_rate.js",
                "resources/js/user_search.js",
                "resources/js/welcome.js",
            ],
            refresh: true,
        }),
    ],
});
