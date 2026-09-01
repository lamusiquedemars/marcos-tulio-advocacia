const eventNames = new Set([
    'whatsapp_click',
    'phone_click',
    'contact_form_start',
    'generate_lead',
    'appointment_request',
    'chat_start',
    'chat_contact_request',
]);

const eventParameterNames = new Set(['location', 'form', 'channel', 'component']);
const attributionParameterNames = [
    'utm_source', 'utm_medium', 'utm_campaign', 'utm_term', 'utm_content',
    'gclid', 'gbraid', 'wbraid',
];
const storageKey = 'maracuja_acquisition_attribution_v1';

function cleanValue(value, maximumLength = 255) {
    if (typeof value !== 'string' && typeof value !== 'number' && typeof value !== 'boolean') {
        return null;
    }

    const cleaned = String(value).trim().slice(0, maximumLength);

    return cleaned === '' ? null : cleaned;
}

export function sanitizeEventParameters(parameters = {}) {
    return Object.entries(parameters).reduce((safe, [key, value]) => {
        if (!eventParameterNames.has(key)) return safe;

        const cleaned = cleanValue(value, 100);
        if (cleaned !== null) safe[key] = cleaned;

        return safe;
    }, {});
}

export function captureCurrentTouch(location = window.location, referrer = document.referrer) {
    const query = new URLSearchParams(location.search);
    const touch = attributionParameterNames.reduce((values, name) => {
        const value = cleanValue(query.get(name));
        if (value !== null) values[name] = value;

        return values;
    }, {});

    return {
        ...touch,
        landing_page: `${location.pathname}${location.search}`.slice(0, 2048),
        referrer: cleanValue(referrer, 2048),
        captured_at: new Date().toISOString(),
    };
}

function readStoredAttribution() {
    try {
        return JSON.parse(window.localStorage.getItem(storageKey)) || null;
    } catch {
        return null;
    }
}

function persistAttribution(currentTouch) {
    const stored = readStoredAttribution();
    const attribution = {
        first_touch: stored?.first_touch || currentTouch,
        last_touch: currentTouch,
    };

    window.localStorage.setItem(storageKey, JSON.stringify(attribution));

    return attribution;
}

function decorateForms(root, attribution) {
    root.querySelectorAll('[data-acquisition-form]').forEach((form) => {
        let input = form.querySelector('input[name="acquisition_attribution"]');

        if (!input) {
            input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'acquisition_attribution';
            form.appendChild(input);
        }

        const update = () => { input.value = JSON.stringify(attribution()); };
        update();
        form.addEventListener('submit', update);
    });
}

export function trackAcquisitionEvent(event, parameters = {}) {
    if (!eventNames.has(event)) return false;
    if (window.MaracujaAcquisitionConfig?.analyticsConsent !== true) return false;

    window.dataLayer = window.dataLayer || [];
    window.dataLayer.push({ event, ...sanitizeEventParameters(parameters) });

    return true;
}

export function initAcquisition(root = document) {
    const config = window.MaracujaAcquisitionConfig;
    if (!config?.enabled) return;

    const currentTouch = captureCurrentTouch();
    let attribution = readStoredAttribution() || {
        first_touch: currentTouch,
        last_touch: currentTouch,
    };

    if (!config.consentEnabled || config.analyticsConsent === true || config.marketingConsent === true) {
        attribution = persistAttribution(currentTouch);
    }

    window.addEventListener('maracuja:consent-updated', (event) => {
        if (event.detail?.analytics === true || event.detail?.marketing === true) {
            attribution = persistAttribution(currentTouch);
        }
    });

    window.MaracujaAcquisition = {
        track: trackAcquisitionEvent,
        attribution: () => structuredClone(attribution),
        allowedEvents: () => [...eventNames],
    };

    (window.MaracujaAcquisitionPendingEvents || []).forEach(({ event, parameters }) => {
        trackAcquisitionEvent(event, parameters);
    });
    window.MaracujaAcquisitionPendingEvents = [];

    document.addEventListener('click', (event) => {
        const link = event.target.closest('a[href]');
        if (!link) return;

        const href = link.getAttribute('href') || '';
        if (href.startsWith('tel:')) {
            trackAcquisitionEvent('phone_click');
            return;
        }

        if (/^https:\/\/(wa\.me|web\.whatsapp\.com)\b/i.test(href)) {
            trackAcquisitionEvent('whatsapp_click');
            return;
        }

        const destination = new URL(href, window.location.origin);

        if (destination.pathname === '/agendamento' || destination.searchParams.get('tipo') === 'consulta') {
            trackAcquisitionEvent('appointment_request');
        }
    });

    decorateForms(root, () => attribution);
}
