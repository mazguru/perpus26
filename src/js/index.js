import Alpine from 'alpinejs';
import persist from '@alpinejs/persist';

// Ekspor ke window agar bisa digunakan di seluruh aplikasi
window.Alpine = Alpine;

Alpine.plugin(persist);
Alpine.start();