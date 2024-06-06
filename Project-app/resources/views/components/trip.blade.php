<div class="trip">
    <h1>Recent Trips</h1>
    <p class="trip-des">You can discover unique places using our serviss</p>
    <div class="tripcard">
        <div class="t-card">
            <div class="t-image">
                <img src="{{ asset('images/Paris.jpg') }}" alt="Trip Image">
            </div>
            <h4>Trip in Paris</h4>
            <p>Paris, the capital of France, offers a captivating blend of historic charm and modern allure. Discover iconic landmarks such as the Eiffel Tower, Notre-Dame Cathedral, and the Louvre Museum. Stroll along the Seine River, enjoy the artistic ambiance of Montmartre, and indulge in world-renowned cuisine at quaint bistros. Paris' rich cultural heritage and romantic atmosphere make it a must-visit destination for travelers.</p>
        </div>
        <div class="t-card">
            <div class="t-image">
                <img src="{{ asset('images/Amsterdam.jpg') }}" alt="Trip Image">
            </div>
            <h4>Trip in Amsterdam</h4>
            <p>Amsterdam, the capital of the Netherlands, is famed for its picturesque canals, historic architecture, and lively cultural scene. Explore the Anne Frank House, the Van Gogh Museum, and the Rijksmuseum for a deep dive into history and art. Rent a bike to navigate the city like a local, and don't miss the vibrant neighborhoods of Jordaan and De Pijp. Amsterdam's blend of old-world charm and contemporary flair promises a delightful travel experience.</p>
        </div>
        <div class="t-card">
            <div class="t-image">
                <img src="{{ asset('images/Berlin.jpg') }}" alt="Trip Image">
            </div>
            <h4>Trip in Berlin</h4>
            <p>Berlin, Germany's capital, is a city of contrasts where history and modernity coexist. Visit remnants of the Berlin Wall, explore the historic Brandenburg Gate, and delve into the diverse exhibits at the Museum Island. The city's vibrant neighborhoods, such as Kreuzberg and Prenzlauer Berg, offer eclectic dining, nightlife, and shopping experiences. Berlin’s dynamic art scene and poignant history ensure a unique and memorable trip.</p>
        </div>
    </div>
</div>

<style>
.trip{
    margin: 4rem 6rem;
    color: #2a2a2a;
}

.trip h1{
    font-size: 3rem;
    text-align: center;
}

.trip-des{
    text-align: center;
    font-size: 1.3rem;
}


.tripcard{
    margin-top: 3rem;
    display: flex;
    justify-content: space-between;
}

.t-card{
    width: 32%;
    text-align: start;
    box-shadow: 0 5px 25px 2px rgba(0,0,0,0.11);
    border-radius: 7px;
    cursor: pointer;
    padding: 1rem .8rem;
}

.t-image{
    height: 200px;
    overflow: hidden;
    border-radius: 7px;
}

.t-image img{
    width: 100%;
    height: 100%;
    transition: 0.3s ease-in-out;
    border-radius: 7px;
}

.t-image:hover{
    transform: scale(1.3);
}

.t-card h4{
    font-size: 1.3rem;
    padding: .9rem 0 .2rem 0;
}

@media screen and (max-width:850px) {
    .trip{
        margin: 4rem 2rem;
    }

    .tripcard{
        flex-direction: column;
    }

    .t-card{
        width: 100%;
        margin-bottom: 1.5rem;
    }
}

<style>