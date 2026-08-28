@if ($acquisitionSettings?->canTrack() && ! $acquisitionSettings->consent_enabled)
    <noscript>
        <iframe
            src="https://www.googletagmanager.com/ns.html?id={{ urlencode($acquisitionSettings->gtm_container_id) }}"
            height="0"
            width="0"
            style="display:none;visibility:hidden"
            title="Google Tag Manager"
        ></iframe>
    </noscript>
@endif
