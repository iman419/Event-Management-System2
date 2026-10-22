
document.addEventListener("DOMContentLoaded", () => {
    const views = document.querySelectorAll(".app-view");
    const navigation = document.querySelector("#mainNavigation");

    function showView(viewId) {
        const targetView = document.getElementById(viewId);

        if (!targetView || !targetView.classList.contains("app-view")) {
            return;
        }

        views.forEach((view) => {
            view.classList.toggle("d-none", view !== targetView);
        });

        document.querySelectorAll("[data-view]").forEach((link) => {
            if (link.classList.contains("nav-link")) {
                link.classList.toggle(
                    "active",
                    link.dataset.view === viewId
                );
            }
        });

        if (navigation && navigation.classList.contains("show")) {
            bootstrap.Collapse.getOrCreateInstance(navigation).hide();
        }

        window.scrollTo({ top: 0, behavior: "smooth" });
    }

    document.addEventListener("click", (event) => {
        const link = event.target.closest("[data-view]");

        if (!link) {
            return;
        }

        const viewId = link.dataset.view;
        const targetView = document.getElementById(viewId);

        if (!targetView || !targetView.classList.contains("app-view")) {
            return;
        }

        event.preventDefault();
        history.pushState({ viewId }, "", `#${viewId}`);
        showView(viewId);
    });

    window.addEventListener("popstate", () => {
        const viewId = window.location.hash.slice(1) || "home";
        showView(viewId);
    });

    document.querySelectorAll("form").forEach((form) => {
        form.addEventListener("submit", (event) => {
            event.preventDefault();

            if (form.id === "eventForm") {
                alert("Static preview only. The event has not been saved.");
                return;
            }

            alert(
                "Static prototype only. This form is not connected to a backend."
            );
        });
    });

    const initialView = window.location.hash.slice(1) || "home";
    showView(initialView);
});
