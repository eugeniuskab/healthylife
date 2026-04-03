<div class="container mt-4">
        <h2>Kontakt</h2>

        <form method="POST" action="index.php?page=contact" id="contactForm" class="mt-3">
            <label class="form-label">Meno</label>
            <input name="name" id="name" class="form-control bg-white" type="text">

            <label class="form-label mt-3">Email</label>
            <input name="email" id="email" class="form-control bg-white" type="email">

            <label class="form-label mt-3">Správa</label>
            <textarea name="message" id="message" class="form-control bg-white" rows="4" placeholder="Napíšte svoju správu..."></textarea>

            <div class="form-check mt-3">
                <input class="form-check-input" type="checkbox" id="gdpr">
                <label class="form-check-label">Súhlasím so spracovaním osobných údajov</label>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Odoslať</button>
        </form>
    </div>