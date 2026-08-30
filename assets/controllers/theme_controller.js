import { Controller } from '@hotwired/stimulus';

/*
 * Contrôleur de bascule de thème sombre/clair.
 * Le bouton (data-controller="theme") appelle toggle() au clic.
 * Le choix est mémorisé dans localStorage pour persister d'une page à l'autre
 * et d'une visite à l'autre. L'application effective du thème au premier
 * chargement (avant même que Stimulus soit prêt) est faite par un petit
 * script inline dans base.html.twig, pour éviter un flash du mauvais thème.
 */
export default class extends Controller {
    toggle() {
        const html = document.documentElement;
        const current = html.getAttribute('data-bs-theme') === 'dark' ? 'dark' : 'light';
        const next = current === 'dark' ? 'light' : 'dark';

        html.setAttribute('data-bs-theme', next);

        try {
            localStorage.setItem('theme', next);
        } catch (e) {
            // localStorage indisponible (navigation privée, etc.) : le thème
            // ne sera simplement pas mémorisé, sans casser le fonctionnement.
        }
    }
}
