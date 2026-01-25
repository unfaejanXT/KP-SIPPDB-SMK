import "./bootstrap";

import Alpine from "alpinejs";

// Import Chart.js
import Chart from "chart.js/auto";

// Import SweetAlert2
import Swal from "sweetalert2";

// Make them globally available
window.Alpine = Alpine;
window.Chart = Chart;
window.Swal = Swal;

Alpine.start();
