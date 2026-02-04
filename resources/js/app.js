import './bootstrap';

import.meta.glob([
  '../images/**',
]);

const notificationBtn = document.querySelector("#notificationBtn");
const notificationPopup = document.querySelector("#popup");

notificationBtn.addEventListener('click', (e) => {
    e.stopPropagation();
    notificationPopup.classList.toggle('hidden');
});

document.addEventListener('click', () => {
    notificationPopup.classList.add('hidden');
});

notificationPopup.addEventListener('click', (e) => {
    e.stopPropagation();
});