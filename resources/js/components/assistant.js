export function initAssistant(root = document) {
    const assistant = root.querySelector('[data-assistant]');

    if (!assistant || assistant.dataset.assistantReady === 'true') {
        return;
    }

    const dialog = assistant.querySelector('[data-assistant-dialog]');
    const form = assistant.querySelector('[data-assistant-form]');
    const steps = [...assistant.querySelectorAll('[data-assistant-step]')];
    const back = assistant.querySelector('[data-assistant-back]');
    const next = assistant.querySelector('[data-assistant-next]');
    const submit = assistant.querySelector('[data-assistant-submit]');
    const status = assistant.querySelector('[data-assistant-status]');
    const urgent = assistant.querySelector('[data-assistant-urgent]');
    let currentStep = 0;
    let completed = false;

    if (!dialog || !form || !steps.length || !back || !next || !submit || !status) {
        return;
    }

    assistant.dataset.assistantReady = 'true';

    const showStep = (index) => {
        currentStep = Math.max(0, Math.min(index, steps.length - 1));
        steps.forEach((step, stepIndex) => {
            step.hidden = stepIndex !== currentStep;
        });
        back.hidden = currentStep === 0;
        next.hidden = currentStep === steps.length - 1;
        submit.hidden = currentStep !== steps.length - 1;
        status.textContent = `Etapa ${currentStep + 1} de ${steps.length}`;
        steps[currentStep].querySelector('input, select, textarea')?.focus();
    };

    const currentStepIsValid = () => {
        const fields = [...steps[currentStep].querySelectorAll('input, select, textarea')];
        const invalid = fields.find((field) => !field.checkValidity());

        invalid?.reportValidity();

        return !invalid;
    };

    assistant.querySelector('[data-assistant-open]')?.addEventListener('click', () => {
        if (completed) {
            form.reset();
            completed = false;
            submit.disabled = false;
            submit.removeAttribute('aria-busy');
            urgent.hidden = true;
            showStep(0);
        }

        dialog.showModal();
        showStep(currentStep);
    });
    assistant.querySelector('[data-assistant-close]')?.addEventListener('click', () => dialog.close());
    next.addEventListener('click', () => {
        if (currentStepIsValid()) {
            showStep(currentStep + 1);
        }
    });
    back.addEventListener('click', () => showStep(currentStep - 1));

    form.querySelectorAll('input[name="urgency"]').forEach((input) => {
        input.addEventListener('change', () => {
            urgent.hidden = input.value !== 'urgente' || !input.checked;
        });
    });

    form.addEventListener('submit', async (event) => {
        event.preventDefault();

        if (!currentStepIsValid()) {
            return;
        }

        submit.disabled = true;
        submit.setAttribute('aria-busy', 'true');
        status.textContent = 'Registrando a solicitação fictícia…';

        try {
            const response = await fetch(assistant.dataset.endpoint, {
                method: 'POST',
                headers: {
                    Accept: 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                },
                body: JSON.stringify(Object.fromEntries(new FormData(form))),
            });
            const payload = await response.json();

            if (!response.ok) {
                const firstError = Object.values(payload.errors || {})[0]?.[0];
                throw new Error(firstError || 'Não foi possível registrar a solicitação.');
            }

            form.reset();
            completed = true;
            steps.forEach((step) => step.hidden = true);
            status.textContent = payload.message;
            back.hidden = true;
            next.hidden = true;
            submit.hidden = true;
        } catch (error) {
            status.textContent = error.message;
            submit.disabled = false;
            submit.removeAttribute('aria-busy');
        }
    });
}
