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
    <section id="cookie-modal" class="cookie-modal" role="dialog" aria-labelledby="cookie-modal-title" aria-describedby="cookie-modal-description" aria-hidden="true">
        <h2 id="cookie-modal-title">Préfér<span>e</span>nces de Cooki<span>e</span>s</h2>
        <div class="cookie-modal-body">
            <p id="cookie-modal-description">Personnalisez vos préférences pour les cookies. Certains cookies sont nécessaires pour le bon fonctionnement du site.</p>

            <!-- Necessary Cookies -->
            <div class="cookie-category">
                <h3>Cookies fonctionnels</h3>
                <p>Ces cookies sont essentiels pour les fonctionnalités de base du site et ne peuvent pas être désactivés.</p>
                <label>
                    <input type="checkbox" checked disabled class="control_indicator form-check-input" />
                    Activé
                </label>
            </div>

            <!-- Analytics Cookies -->
            <div class="cookie-category">
                <h3>Cookies d'analyse</h3>
                <p>Ces cookies permettent de suivre l'utilisation du site pour améliorer nos services (Google Analytics).</p>
                <label>
                    <input type="checkbox" id="analytics-cookies" class="control_indicator form-check-input" />
                    Activer les Cookies d'analyse
                </label>
            </div>

            <!-- Marketing Cookies -->
            <div class="cookie-category">
                <h3>Cookies Multimedia & Marketing</h3>
                <p>Ces cookies permettent d'intégrer nos vidéos originales ainsi que des extraits provenant de tiers (YouTube, Vimeo, Dailymotion).</p>
                <label>
                    <input type="checkbox" id="marketing-cookies" class="control_indicator form-check-input" />
                    Activer les Cookies Multimedia & Marketing
                </label>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary submit-filters" id="btn-save-preferences" role="button" aria-label="Enregistrer les préférences de cookies">Enregistrer les Préférences</button>
                <button type="cancel" class="btn btn-secondary" id="btn-close-modal" role="button" aria-label="Fermer la fenêtre de préférences">Fermer</button>
            </div>
        </div>

    </section>
</template>