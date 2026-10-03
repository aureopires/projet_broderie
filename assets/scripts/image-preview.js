document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('[data-image-input]').forEach((element) => {
        if (!(element instanceof HTMLInputElement)) {
            return;
        }

        const form = element.closest('form');
        const previewContainer = form?.querySelector('[data-image-preview-container]');
        const previewImage = previewContainer?.querySelector('[data-image-preview]');

        if (
            !(previewContainer instanceof HTMLElement)
            || !(previewImage instanceof HTMLImageElement)
        ) {
            return;
        }

        let previewUrl;

        element.addEventListener('change', () => {
            if (previewUrl) {
                URL.revokeObjectURL(previewUrl);
                previewUrl = undefined;
            }

            const imageFile = element.files?.[0];

            if (!imageFile) {
                previewImage.removeAttribute('src');
                previewContainer.hidden = true;
                return;
            }

            previewUrl = URL.createObjectURL(imageFile);
            previewImage.src = previewUrl;
            previewContainer.hidden = false;
        });
    });
});
