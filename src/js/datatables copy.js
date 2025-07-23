import Alpine from 'alpinejs';
import persist from '@alpinejs/persist';
import DataTable from 'datatables.net';

// Import Toastr dengan benar
import Notifier from './notifier';

// Import DataTables Responsive
import 'datatables.net-responsive';

// Ekspor ke window agar bisa digunakan di seluruh aplikasi
window.Alpine = Alpine;
window.DataTable = DataTable;
window.Notifier = Notifier; // ✅ Pastikan toastr tersedia di global scope

Alpine.plugin(persist);
Alpine.start();