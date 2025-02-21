function toggleAccordion(id, button) {
    const content = document.getElementById(id);
    const arrow = button.querySelector('.arrow');

    content.classList.toggle('hidden');
    arrow.classList.toggle('rotate');
}
