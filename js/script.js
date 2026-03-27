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

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    form.addEventListener("submit", (e) => {
        e.preventDefault();

        const meno = document.getElementById("meno").value.trim();
        const email = document.getElementById("email").value.trim();
        const sprava = document.getElementById("sprava").value.trim();
        const checkbox = document.getElementById("gdpr").checked;

        if (!meno || !sprava) {
            alert("Vyplňte všetky polia.");
            return;
        }

        if (!emailRegex.test(email)) {
            alert("Zadajte platný e-mail.");
            return;
        }

        if (!checkbox) {
            alert("Musíte súhlasiť so spracovaním osobných údajov.");
            return;
        }

        window.location.href = "thankyou.html";

        form.reset();
    });
});