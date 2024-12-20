document.addEventListener("DOMContentLoaded", function () {
    const sidebar = document.getElementById("sidebar");
    const toggleBtn = document.getElementById("toggleSidebarBtn");

    toggleBtn.addEventListener("click", function () {
        sidebar.classList.toggle("sidebar-hidden");
    });
});
