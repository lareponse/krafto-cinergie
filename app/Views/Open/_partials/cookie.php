<!-- Cookie Banner -->
<div id="cookie-banner" class="cookie-banner" role="dialog" aria-labelledby="cookie-banner-title" aria-describedby="cookie-banner-description" aria-modal="true">
    <h2 id="cookie-banner-title" class="visually-hidden">Gestion des Cookies</h2>
    <p id="cookie-banner-description">
        Nous utilisons des cookies pour assurer les fonctionnalités essentielles du site, analyser l'utilisation du site (Google Analytics) et intégrer des vidéos (YouTube, Vimeo, Dailymotion). Ces services peuvent déposer des cookies à des fins marketing.<br />
        Consultez notre <a href="/mentions-legales">Politique de Confidentialité</a> pour plus de détails.
    </p>
    <div class="cookie-banner-buttons">
        <button class="btn btn-primary" role="button" id="cookie-banner-accept-all" aria-label="Accepter tous les cookies">Accepter tout</button>
        <button class="btn btn-outline-primary" role="button" id="cookie-banner-decline-all" aria-label="Refuser tous les cookies">Refuser tout</button>
        <button class="btn btn-secondary" role="button" id="cookie-banner-customize" aria-label="Personnaliser les préférences de cookies">Personnaliser</button>
    </div>
</div>

<template id="cookie-modal-template">
    <!-- Cookie Preferences Modal -->
    <section id="cookie-modal" class="cookie-modal shadow-box modal-box" role="dialog" aria-labelledby="cookie-modal-title" aria-describedby="cookie-modal-description" aria-hidden="true">
        <h2 id="cookie-modal-title">Préfér<span>e</span>nces de Cooki<span>e</span>s</h2>
        <div class="cookie-modal-body">
            <p id="cookie-modal-description">Personnalisez vos préférences pour les cookies. Certains cookies sont nécessaires pour le bon fonctionnement du site.</p>

            <!-- Necessary Cookies -->
            <fieldset class="cookie-category">
                <input type="checkbox" id="functional-cookies" checked disabled class="control_indicator form-check-input" />
                <label for="functional-cookies" class="h3 ms-2">Cookies fonctionnels activés</label>
            </fieldset>
            <p>Ces cookies sont essentiels pour les fonctionnalités de base du site et ne peuvent pas être désactivés.</p>

            <!-- Analytics Cookies -->
            <fieldset class="cookie-category">
                <input type="checkbox" id="analytics-cookies" class="control_indicator form-check-input" />
                <label for="analytics-cookies" class="h3 ms-2">Activer les Cookies d'analyse</label>
            </fieldset>
            <p>Ces cookies permettent de suivre l'utilisation du site pour améliorer nos services (Google Analytics).</p>

            <!-- Marketing Cookies -->
            <fieldset class="cookie-category">
                <input type="checkbox" id="marketing-cookies" class="control_indicator form-check-input" />
                <label for="marketing-cookies" class="h3 ms-2">Activer les Cookies Multimedia & Marketing</label>
            </fieldset>
            <p>Ces cookies permettent d'intégrer nos vidéos originales ainsi que des extraits provenant de tiers (YouTube, Vimeo, Dailymotion).</p>

        </div>
        <div class=" shadow-box-controls">
            <button type="submit" role="button" id="btn-confirm-modal" class="btn btn-primary submit-filters" aria-label="Enregistrer les préférences de cookies">Enregistrer les Préférences</button>
            <button type="button" role="button" id="btn-cancel-modal" class="btn btn-secondary" aria-label="Fermer la fenêtre de préférences">Fermer</button>
        </div>
    </section>
</template>