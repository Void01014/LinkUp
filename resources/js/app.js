alert()
import './bootstrap';

import.meta.glob([
    '../images/**',
]);

// const notificationBtn = document.querySelector("#notificationBtn");
// const notificationPopup = document.querySelector("#popup");

// notificationBtn.addEventListener('click', (e) => {
//     e.stopPropagation();
//     notificationPopup.classList.toggle('hidden');
// });

// document.addEventListener('click', () => {
//     notificationPopup.classList.add('hidden');
// });

// notificationPopup.addEventListener('click', (e) => {
//     e.stopPropagation();
// });



document.addEventListener('click', () => {
    document.querySelectorAll('.popup-class').forEach(p => p.classList.add('hidden'));
    moreBtns.forEach(m => m.classList.remove('hidden'));
});
