(function () {
    function initMobileNavbar() {
        var mobileNavbar = document.querySelector(".navbar");
        if (!mobileNavbar) {
            return;
        }

        var toggleButton = mobileNavbar.querySelector(".menu-toggle");
        if (!toggleButton) {
            return;
        }

        var closeMenu = function () {
            mobileNavbar.classList.remove("menu-open");
            toggleButton.setAttribute("aria-expanded", "false");
        };

        toggleButton.addEventListener("click", function () {
            var isOpen = mobileNavbar.classList.toggle("menu-open");
            toggleButton.setAttribute("aria-expanded", String(isOpen));
        });

        mobileNavbar.querySelectorAll(".menu a").forEach(function (link) {
            link.addEventListener("click", function () {
                if (window.innerWidth <= 991.98) {
                    closeMenu();
                }
            });
        });

        window.addEventListener("resize", function () {
            if (window.innerWidth > 991.98) {
                closeMenu();
            }
        });
    }

    if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", initMobileNavbar);
    } else {
        initMobileNavbar();
    }
})();
