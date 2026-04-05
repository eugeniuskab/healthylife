<section class="carousel">
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
        </div>

        <div class="carousel-inner mt-3">
            <div class="carousel-item active">
                <img src="img/people.jpg" class="carousel-custom-img" alt="Prvý obrazok">
            </div>
            <div class="carousel-item">
                <img src="img/diet.jpg" class="carousel-custom-img" alt="Druhý obrazok">
            </div>
            <div class="carousel-item">
                <img src="img/traning.jpg" class="carousel-custom-img" alt="Tretí obrazok">
            </div>
            <div class="carousel-item">
                <img src="img/sleep.jpg" class="carousel-custom-img" alt="Štvrtý obrazok">
            </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>

<!-- cards -->
<section class="container my-5">
    <h2 class="text-center mb-4">Zdravý životný štýl</h2>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card h-100 shadow-sm bg-success">
                <div class="card-body d-flex flex-column">
                    <h4 class="card-title">Strava</h4>
                    <p class="card-text">
                        Vyvážená strava je základom zdravia. Ovplyvňuje energiu, imunitu,
                        regeneráciu tela a celkovú pohodu. Správne stravovanie podporuje 
                        výkon aj zdravé fungovanie organizmu.
                    </p>
                    <a href="index.php?page=diet" class="btn btn-primary mt-auto w-auto align-self-start">Prejsť na stránku</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 shadow-sm bg-success">
                <div class="card-body d-flex flex-column">
                    <h4 class="card-title">Šport</h4>
                    <p class="card-text">
                        Pohyb posilňuje svaly, podporuje srdce a znižuje stres.
                        Pravidelné cvičenie zlepšuje náladu, kondíciu aj kvalitu života.
                    </p>
                    <a href="index.php?page=exercise" class="btn btn-primary mt-auto w-auto align-self-start">Prejsť na stránku</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 shadow-sm bg-success">
                <div class="card-body d-flex flex-column">
                    <h4 class="card-title">Spánok</h4>
                    <p class="card-text">
                        Kvalitný spánok regeneruje telo aj myseľ. Ovplyvňuje koncentráciu,
                        pamäť, imunitu a emocionálnu stabilitu. Je to nevyhnutná súčasť zdravia.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>