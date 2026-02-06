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

const moreBtns = document.querySelectorAll(".moreBtn");

moreBtns.forEach((moreBtn) => {
    // 1. Get the specific popup for THIS button
    const currentPopup = moreBtn.nextElementSibling;

    moreBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        // 2. Toggle only this specific popup
        moreBtn.classList.toggle('hidden');
        currentPopup.classList.toggle('hidden');
    });
    
    currentPopup.addEventListener('click', (e) => {
        e.stopPropagation();
    });
});

document.addEventListener('click', () => {
    document.querySelectorAll('.popup-class').forEach(p => p.classList.add('hidden'));
    moreBtns.forEach(m => m.classList.remove('hidden'));
});