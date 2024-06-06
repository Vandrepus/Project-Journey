<div class="{{ $cName }}">
    <img alt="HeroImg" src="{{ asset($heroImg) }}">
    <div class="hero-text">
        <h1>{{ $title }}</h1>

        @isset($text) 
            <p>{{ $text }}</p>
        @endisset

        @isset($buttonText)
            <a href="{{ $url }}" class="{{ isset($btnClass) ? $btnClass : '' }}">{{ $buttonText }}</a>
        @endisset
    </div>
</div>

<style>
.hero {
    width: 100%;
    height: 100vh;
    position: relative;
}

.hero-mid {
    width: 100%;
    height: 70vh;
    position: relative;
}

.hero-mid h1 {
    padding-top: 4rem !important;
}

img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.hero-text {
    position: absolute;
    top: 55%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.hero-text h1 {
    font-size: 3rem;
    font-weight: 800;
    background: #fff;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    align-items: center;
}

.hero-text p {
    font-size: 1.3rem;
    color: #fff;
    padding: 0.5rem 0 2rem 0;
}

.hero-text .show {
    text-decoration: none;
    background: #fff;
    padding: 1rem 2rem;
    border-radius: 6px;
    font-size: 1.1rem;
    font-weight: bold;
    letter-spacing: 2px;
    color: #222;
}

.hero-text .hide {
    display: none;
}

/* Media Query */
@media screen and (max-width: 555px) {
    .hero-text h1 {
        padding: 10px 20px;
    }

    .hero-text p {
        font-size: 1.1rem;
        padding: 0 0 2rem 0;
    }

    .hero-text .show {
        padding: 0.6rem 1.1rem;
        border-radius: 6px;
        font-size: 1rem;
    }
}
</style>
