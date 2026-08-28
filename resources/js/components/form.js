import { queryAll } from '../core/dom';

export function initFormStates(root = document) {
    queryAll('form[data-form]', root).forEach((form) => {
        if (form.dataset.formReady === 'true') {
            return;
        }

        form.dataset.formReady = 'true';

        form.addEventListener('submit', () => {
            const submitter = form.querySelector('[type="submit"]');

            form.classList.add('is-submitting');
            submitter?.setAttribute('aria-busy', 'true');
        });
    });

    queryAll('form[data-contact-consultation]', root).forEach((form) => {
        if (form.dataset.contactConsultationReady === 'true') {
            return;
        }

        const panel = form.querySelector('[data-contact-consultation-panel]');
        const modalities = panel?.querySelectorAll('input[name="modality"]') ?? [];
        const requestTypes = form.querySelectorAll('input[name="request_type"]');

        if (!panel || requestTypes.length === 0) {
            return;
        }

        form.dataset.contactConsultationReady = 'true';

        const update = () => {
            const isConsultation = form.querySelector('input[name="request_type"]:checked')?.value === 'consulta';

            panel.hidden = !isConsultation;
            modalities.forEach((input) => {
                input.required = isConsultation;
            });
        };

        requestTypes.forEach((input) => input.addEventListener('change', update));
        update();
    });
}
