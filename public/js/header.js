document.addEventListener("DOMContentLoaded", function () {
    const userMenu = document.querySelector(".user-menu");
    const dropdown = document.querySelector(".user-dropdown");

    if (userMenu && dropdown) {
        userMenu.addEventListener("click", function (e) {
            e.stopPropagation();
            dropdown.classList.toggle("show");
        });
    }

    document.addEventListener("click", function () {
        dropdown?.classList.remove("show");
    });
});
