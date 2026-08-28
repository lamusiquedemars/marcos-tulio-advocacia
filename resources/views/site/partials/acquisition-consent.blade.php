@if ($acquisitionSettings?->canTrack() && $acquisitionSettings->consent_enabled)
    @php
        $privacyUrl = $acquisitionSettings->privacy_policy_url ?: route('pages.show', 'mentions-legales');
    @endphp

    <aside class="consent-banner" data-consent-banner aria-label="Escolha de cookies" hidden>
        <strong>Cookies de medição</strong>
        <p>Com a sua autorização, usamos cookies de medição para entender o uso do site e melhorar o atendimento.</p>
        <p><a href="{{ $privacyUrl }}">Saiba mais no aviso legal e de privacidade</a></p>
        <div class="consent-banner__actions">
            <button class="btn btn--primary" type="button" data-acquisition-consent="granted">Aceitar</button>
            <button class="btn btn--secondary" type="button" data-acquisition-consent="denied">Recusar</button>
        </div>
    </aside>

    <script>
        (() => {
            const banner = document.querySelector('[data-consent-banner]');
            const key = 'maracuja_analytics_consent';
            const cookieValue = document.cookie.match(new RegExp(`(?:^|; )${key}=([^;]+)`))?.[1];
            const saved = cookieValue || window.localStorage.getItem(key);

            const persist = (value) => {
                const secure = window.location.protocol === 'https:' ? '; Secure' : '';
                document.cookie = `${key}=${value}; Max-Age=15552000; Path=/; SameSite=Lax${secure}`;
                window.localStorage.setItem(key, value);
            };

            const apply = (value) => {
                window.maracujaSetConsent?.({
                    analytics: value === 'granted',
                    marketing: false,
                });
            };

            if (! saved) {
                banner.hidden = false;
            } else {
                apply(saved);
            }

            document.querySelectorAll('[data-acquisition-consent]').forEach((button) => {
                button.addEventListener('click', () => {
                    const value = button.dataset.acquisitionConsent;
                    persist(value);
                    apply(value);
                    banner.hidden = true;
                });
            });
        })();
    </script>

    @if (session('acquisition_generate_lead'))
        <script>
            window.MaracujaAcquisitionPendingEvents = window.MaracujaAcquisitionPendingEvents || [];
            window.MaracujaAcquisitionPendingEvents.push({
                event: 'generate_lead',
                parameters: { form: 'contact' },
            });
        </script>
    @endif
@endif
