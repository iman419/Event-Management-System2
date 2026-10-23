
document.addEventListener("DOMContentLoaded", () => {
    const viewContainer = document.querySelector("#view-container");
    const navigation = document.querySelector("#mainNavigation");

    const validViews = [
        "home",
        "events",
        "event-details",
        "categories",
        "dashboard",
        "registrations",
        "profile",
        "login",
        "register",
        "admin",
        "admin-events",
        "admin-categories",
        "admin-venues",
        "weather"
    ];

    async function showView(viewId) {
        const selectedView = validViews.includes(viewId) ? viewId : "home";

        try {
            const response = await fetch(`./${selectedView}.html`);

            if (!response.ok) {
                throw new Error(`Could not load ${selectedView}.html`);
            }

            const html = await response.text();
            viewContainer.innerHTML = html;

            document.querySelectorAll(".navbar [data-view]").forEach((link) => {
                link.classList.toggle(
                    "active",
                    link.dataset.view === selectedView
                );
            });

            if (
                navigation &&
                navigation.classList.contains("show") &&
                window.bootstrap
            ) {
                window.bootstrap.Collapse
                    .getOrCreateInstance(navigation)
                    .hide();
            }

            bindForms();

            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        } catch (error) {
            console.error("View loading error:", error);

            viewContainer.innerHTML = `
                <div class="alert alert-danger" role="alert">
                    <h1 class="h4">Unable to load this page</h1>
                    <p class="mb-0">
                        Please check that the view file exists in
                        <code>frontend/views/</code> and reload the page.
                    </p>
                </div>
            `;
        }
    }

    function bindForms() {
        const forms = viewContainer.querySelectorAll("form");

        forms.forEach((form) => {
            form.addEventListener("submit", (event) => {
                event.preventDefault();

                if (form.id === "eventForm") {
                    alert(
                        "Static preview only. The event has not been saved."
                    );
                    return;
                }

                if (form.id === "categoryForm") {
                    alert(
                        "Static preview only. The category has not been saved."
                    );
                    return;
                }

                if (form.id === "venueForm") {
                    alert(
                        "Static preview only. The venue has not been saved."
                    );
                    return;
                }

                if (form.id === "loginForm") {
                    alert(
                        "Static prototype only. Login is not connected to a backend."
                    );
                    return;
                }

                if (form.id === "registerForm") {
                    alert(
                        "Static prototype only. Account creation is not connected to a backend."
                    );
                    return;
                }

                alert(
                    "Static prototype only. This form is not connected to a backend."
                );
            });
        });
    }

    document.addEventListener("click", (event) => {
        const link = event.target.closest("[data-view]");

        if (!link) {
            return;
        }

        const viewId = link.dataset.view;

        if (!validViews.includes(viewId)) {
            return;
        }

        event.preventDefault();

        if (window.location.hash !== `#${viewId}`) {
            window.history.pushState(
                { viewId },
                "",
                `#${viewId}`
            );
        }

        showView(viewId);
    });

    window.addEventListener("popstate", () => {
        const viewId = window.location.hash.slice(1) || "home";
        showView(viewId);
    });

    const initialView = window.location.hash.slice(1) || "home";
    showView(initialView);
});
