document.addEventListener("DOMContentLoaded", function () {
    var scrollToTopButton = document.querySelector(".scroll-up-button");

    // Show the button after scrolling down 300px
    window.addEventListener("scroll", function () {
        if (window.scrollY > 300) {
            scrollToTopButton.style.display = "flex";
        } else {
            scrollToTopButton.style.display = "none";
        }
    });

    // Scroll to top when clicked
    scrollToTopButton.addEventListener("click", function (e) {
        e.preventDefault();
        window.scrollTo({ top: 0, behavior: "smooth" });
    });
});

// mobile menu
document.addEventListener("DOMContentLoaded", function () {
    const menuIcon = document.getElementById("hamburger-menu");
    let nav = document.getElementById("top-navi");
    const closeBtn = document.querySelector(".close-btn");

    function updateNavID() {
        if (window.innerWidth <= 1024) {
            nav.id = "top-navi-mobile";
        } else {
            nav.id = "top-navi";
        }
    }

    // Run on page load and window resize
    updateNavID();
    window.addEventListener("resize", function () {
        updateNavID();
        nav = document.getElementById(window.innerWidth <= 1024 ? "top-navi-mobile" : "top-navi"); // Update reference
    });

    // Toggle mobile menu when clicking the hamburger icon
    menuIcon.addEventListener("click", function () {
        if (nav.id === "top-navi-mobile") {
            nav.classList.toggle("active");
        }
    });

    // Close menu when clicking the close button
    closeBtn.addEventListener("click", function () {
        nav.classList.remove("active");
    });

    // Close menu when clicking outside
    document.addEventListener("click", function (event) {
        if (nav.id === "top-navi-mobile" && !menuIcon.contains(event.target) && !nav.contains(event.target)) {
            nav.classList.remove("active");
        }
    });

    // Close menu on Escape key press
    document.addEventListener("keydown", function (event) {
        if (event.key === "Escape") {
            nav.classList.remove("active");
        }
    });
});



// Detect Scroll and Change Background of header
document.addEventListener("DOMContentLoaded", function () {
    const header = document.getElementById("main-header");

    window.addEventListener("scroll", function () {
        if (window.scrollY > 50) { // Change background when scrolled down 50px
            header.classList.add("scrolled");
        } else {
            header.classList.remove("scrolled");
        }
    });
});

//Banner modal form

document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("membershipModal");
    const openBtn = document.getElementById("openModal");
    const closeBtn = document.querySelector(".close-modal");

    // Open Modal
    openBtn.addEventListener("click", function () {
        modal.style.display = "flex";
         modal.classList.add("active");
    });

    // Close Modal When Clicking "X"
    closeBtn.addEventListener("click", function () {
        modal.style.display = "none";
         modal.classList.add("active");
    });

    // Close Modal When Clicking Outside Content
    window.addEventListener("click", function (event) {
        if (event.target === modal) {
            // modal.style.display = "none";
             modal.classList.add("active");
        }
    });

    // Close Modal on "Escape" Key Press
    document.addEventListener("keydown", function (event) {
        if (event.key === "Escape") {
            // modal.style.display = "none";
            modal.classList.remove("active");
        }
    });
});
//Enable Click-to-Toggle Sub-Menus
document.addEventListener("DOMContentLoaded", function () {
    const menuItems = document.querySelectorAll("#top-navi ul.menu > li > a");

    menuItems.forEach(function (menuItem) {
        menuItem.addEventListener("click", function (event) {
            // event.preventDefault(); // Prevent navigation

            let parentLi = this.parentElement;
            let subMenu = parentLi.querySelector(".sub-menu");

            if (subMenu) {
                // Toggle active class on the parent <li>
                parentLi.classList.toggle("active");

                // Close other open sub-menus (optional)
                document.querySelectorAll("#top-navi ul.menu li.active").forEach(function (li) {
                    if (li !== parentLi) {
                        li.classList.remove("active");
                    }
                });
            }
        });
    });
});

//Enable Click-to-Toggle Sub-Menus in mobile version
document.addEventListener("DOMContentLoaded", function () {
    const menuItems = document.querySelectorAll("#top-navi-mobile ul.menu > li > a");

    menuItems.forEach(function (menuItem) {
        menuItem.addEventListener("click", function (event) {
            let parentLi = this.parentElement;
            let subMenu = parentLi.querySelector(".sub-menu");

            if (subMenu) {
                // Если у пункта меню есть подменю, отменяем переход и открываем/закрываем его
                event.preventDefault();

                let isActive = parentLi.classList.contains("active");

                // Закрываем все остальные открытые подменю
                document.querySelectorAll("#top-navi-mobile ul.menu li.active").forEach(function (li) {
                    li.classList.remove("active");
                });

                // Открываем текущее подменю, если оно было закрыто
                if (!isActive) {
                    parentLi.classList.add("active");
                }
            } else {
                // Если подменю нет, разрешаем обычный переход по ссылке
                window.location.href = this.href;
            }
        });
    });

    // Закрытие подменю при клике вне меню
    document.addEventListener("click", function (event) {
        if (!event.target.closest("#top-navi-mobile")) {
            document.querySelectorAll("#top-navi-mobile ul.menu li.active").forEach(function (li) {
                li.classList.remove("active");
            });
        }
    });
});

//Prevents the main page from scrolling when the menu is open and allows scrolling inside the mobile menu
document.addEventListener("DOMContentLoaded", function () {
    const menuIcon = document.getElementById("hamburger-menu");
    let nav = document.getElementById("top-navi-mobile");
    const closeBtn = document.querySelector(".close-btn");

    // Open the mobile menu and disable background scrolling
    menuIcon.addEventListener("click", function () {
        nav.classList.add("active");
        document.body.style.overflow = "hidden";
    });

    // Close the menu and re-enable background scrolling
    closeBtn.addEventListener("click", function () {
        nav.classList.remove("active");
        document.body.style.overflow = "visible";
        console.log("Body overflow set to:", document.body.style.overflow);
    });

    // Close menu when clicking outside
    document.addEventListener("click", function (event) {
        if (!menuIcon.contains(event.target) && !nav.contains(event.target)) {
            nav.classList.remove("active");
            document.body.style.overflow = "visible";
        }
    });

    // Close menu on Escape key press
    document.addEventListener("keydown", function (event) {
        if (event.key === "Escape") {
            nav.classList.remove("active");
            document.body.style.overflow = "";
        }
    });
});
//good function for overflow in console
// document.querySelectorAll('*').forEach(el => {
//   if (el.scrollWidth > document.documentElement.clientWidth) {
//     console.log('Overflow:', el);
//   }
// });