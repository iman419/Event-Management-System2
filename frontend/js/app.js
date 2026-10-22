document.addEventListener("DOMContentLoaded", () => {
    const forms = document.querySelectorAll("form");

    forms.forEach((form) => {
        form.addEventListener("submit", (event) => {
            event.preventDefault();

            alert(
                "This is a static prototype. Login and registration will be implemented in a later milestone."
            );
        });
    });
});