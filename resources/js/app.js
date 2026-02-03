import './bootstrap';

import swal from 'sweetalert';

window.swal = swal;

import.meta.glob([
  '../images/**',
]);

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
