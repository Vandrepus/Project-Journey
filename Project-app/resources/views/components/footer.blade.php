<div class="footer">
    <div class="top">
        <div>
            <h1>JourneyHub</h1>
            <p>Discover Your Next Adventure: Where Every Destination Becomes a Favorite</p>
        </div>

        <div>
            {{-- Logo section: Add your logo here if needed --}}
        </div>
    </div>

    <div class="bottom">
        <div>
            <h4>About JourneyHub</h4>
            <a href="/about">About Us</a>
        </div>
        <div>
            <h4>Community</h4>
            <a href="https://github.com/Vandrepus">Github</a>
            <a href="/">Project Change Log</a>
        </div>
        <div>
            <h4>Help</h4>
            <a href="/contact">Contact Us</a>
        </div>
        <div>
            <h4>Others</h4>
            <a href="/">Terms of Service</a>
            <a href="/">Privacy Policy</a>
            <a href="/">License</a>
        </div>
    </div>
</div>

<style>
.footer {
    padding: 4rem 6rem;
    background: #000;
    color: #fff;
}

.top {
    display: flex;
    align-items: center;
    text-align: start;
    justify-content: space-between;
    flex-wrap: wrap;
}
.top h1{
    font-size: 1.2rem;
}

.bottom {
    padding-top: 2rem;
    text-align: start;
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
}

.bottom div {
    display: flex;
    flex-direction: column;
}

.bottom h4 {
    font-size: 1.3rem;
    padding: 1rem 0 .8rem 0;
}

.bottom a {
    text-decoration: none;
    color: #fafafa;
    padding-bottom: .4rem;
    font-size: 1.1rem;
}

@media screen and (max-width: 850px) {
    .footer {
        padding: 4rem 2rem;
    }

    .bottom div {
        width: 50%;
    }
}
</style>
