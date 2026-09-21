document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('#quote-request-form');
    const preview = document.querySelector('#quote-preview');

    if (!form || !preview) {
        return;
    }

    const fields = {
        articleType: preview.querySelector('[data-preview="articleType"]'),
        markingType: preview.querySelector('[data-preview="markingType"]'),
        quantity: preview.querySelector('[data-preview="quantity"]'),
        firstName: preview.querySelector('[data-preview="firstName"]'),
        lastName: preview.querySelector('[data-preview="lastName"]'),
        organizationType: preview.querySelector('[data-preview="organizationType"]'),
    };

    const getValue = (name) => form.elements[name]?.value.trim() || '—';

    const updatePreview = () => {
        fields.articleType.textContent = getValue('quote_request[articleType]');
        fields.markingType.textContent = getValue('quote_request[markingType]');
        fields.quantity.textContent = getValue('quote_request[quantity]');
        fields.firstName.textContent = getValue('quote_request[firstName]');
        fields.lastName.textContent = getValue('quote_request[lastName]');
        fields.organizationType.textContent = getValue('quote_request[organizationType]');
    };

    form.addEventListener('input', updatePreview);
    form.addEventListener('change', updatePreview);
    updatePreview();
});
