import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import ujs from '@rails/ujs';

ujs.start();
document.addEventListener('DOMContentLoaded', function () {
    const resetButton = document.querySelector('button[type="reset"]');
    resetButton.addEventListener('click', function (event) {
        event.preventDefault();
        const form = this.form;
        form.reset();
        const url = new URL(form.action);
        url.searchParams.delete('filter[status_id]');
        url.searchParams.delete('filter[created_by_id]');
        url.searchParams.delete('filter[assigned_to_id]');
        window.location.href = url.toString();
    });
});
