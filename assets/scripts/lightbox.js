import { Modal } from 'bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    const modalElement = document.querySelector('#gallery-lightbox');
    const modalImage = modalElement?.querySelector('[data-lightbox-image]');
    const modalTitle = modalElement?.querySelector('[data-lightbox-title]');

    if (!modalElement || !modalImage || !modalTitle) {
        return;
    }

    const modal = new Modal(modalElement);
    let lastTrigger = null;

    document.querySelectorAll('[data-lightbox-src]').forEach((trigger) => {
        trigger.addEventListener('click', () => {
            lastTrigger = trigger;
            modalImage.src = trigger.dataset.lightboxSrc;
            modalImage.alt = trigger.dataset.lightboxTitle || '';
            modalTitle.textContent = trigger.dataset.lightboxTitle || '';
            modal.show();
        });
    });

    modalElement.addEventListener('hidden.bs.modal', () => {
        modalImage.src = '';
        modalImage.alt = '';
        modalTitle.textContent = '';
        lastTrigger?.focus();
    });
});
