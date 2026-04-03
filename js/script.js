// progress bar
document.addEventListener("DOMContentLoaded", () => {
    const checkButtons = document.querySelectorAll(".check-btn");
    const progressBar = document.querySelector(".progress-bar");

    function updateProgress() {
        const total = checkButtons.length;
        const checked = document.querySelectorAll(".check-btn.checked").length;
        const percent = Math.round((checked / total) * 100);

        if (progressBar) {
            progressBar.style.width = percent + "%";
            progressBar.textContent = percent + "%";
        }
    }

    checkButtons.forEach(btn => {
        btn.addEventListener("click", () => {
            btn.classList.toggle("checked");
            updateProgress();
        });
    });

    updateProgress();
    // forma
    const form = document.getElementById("contactForm");
    if (!form) return;

    if (form) {
        form.addEventListener("submit", (e) => {

        const name = document.getElementById("name").value.trim();
        const email = document.getElementById("email").value.trim();
        const message = document.getElementById("message").value.trim();
        const checkbox = document.getElementById("gdpr").checked;

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!name || !message) {
            alert("Vyplňte všetky polia.");
            e.preventDefault();
            return;
        }

        if (!emailRegex.test(email)) {
            alert("Zadajte platný e-mail.");
            e.preventDefault();
            return;
        }

        if (!checkbox) {
            alert("Musíte súhlasiť so spracovaním osobných údajov.");
            e.preventDefault();
            return;
        }
        });
    }
});