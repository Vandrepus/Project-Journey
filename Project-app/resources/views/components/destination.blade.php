<div class="destination">
    <h1>Popular Destinations Shared by Our Community</h1>
    <p>Discover hidden gems, share your experiences, and get travel tips from fellow explorers!</p>
    
    <x-destination-data 
        class="first-des" 
        heading="Burj Khalifa, Dubai"
        text="Standing at an incredible 828 meters, Burj Khalifa is the tallest building in the world. This modern architectural marvel offers stunning panoramic views of Dubai from its observation decks. At night, the tower is illuminated with dazzling lights, making it a true symbol of luxury and innovation."
        img1="Dubai.jpg"
        img2="Dubai1.jpeg"
    />

    <x-destination-data 
        class="first-des-reverse" 
        heading="Pura Lempuyang, Bali"
        text="Known as the 'Gates of Heaven,' Pura Lempuyang is one of Bali’s most iconic temples. Located high on Mount Lempuyang, this sacred site offers breathtaking views of Mount Agung framed by its famous split gates. A visit here is a spiritual and scenic experience like no other."
        img1="Bali.jpeg"
        img2="Bali1.jpg"
    />

    <x-destination-data 
        class="first-des" 
        heading="Tower Bridge, London"
        text="A symbol of London, Tower Bridge is one of the most recognizable structures in the world. Built in the 19th century, it combines stunning Victorian Gothic architecture with a fascinating history. Visitors can walk across its glass floor and enjoy spectacular views of the Thames River."
        img1="London.jpg"
        img2="London1.jpg"
    />

    <x-destination-data 
        class="first-des-reverse" 
        heading="Train Street, Hanoi"
        text="One of Hanoi’s most unique attractions, Train Street is a narrow alley lined with cafés where trains pass just inches away from visitors. It’s a fascinating place to experience local life, sip on Vietnamese coffee, and witness the thrilling moment when a train rushes through the street."
        img1="Hanoi.jpg"
        img2="Hanoi1.jpg"
    />

    <x-destination-data 
        class="first-des" 
        heading="Colosseum, Rome"
        text="The Colosseum, an ancient Roman amphitheater, is one of the most visited landmarks in the world. Built nearly 2,000 years ago, this massive structure once hosted gladiator battles and grand spectacles. Today, it stands as a testament to the grandeur of the Roman Empire."
        img1="Rome.jpg"
        img2="Rome1.jpg"
    />
</div>



<style>
    .destination{
    margin: 4rem 6rem;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.destination h1{
    font-size: 3rem;
}

.first-des{
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: 4.5rem;
}

.first-des-reverse{
    display: flex;
    flex-direction: row-reverse;
    align-items: center;
    justify-content: space-between;
    margin-top: 4.5rem;
}

.des-text{
    width: 45%;
    text-align: start;
    font-size: 1.1rem;

}

.des-text h2{
    padding-bottom: 1rem;
}

.image{
    position: relative;
    width: 50%;
    display: flex;
    justify-content: space-between;
    z-index: -99;
}

.image img{
    width: 49%;
    height: 350px;
    object-fit: cover;
    border-radius: 6px;
    box-shadow: -1px 1px 62px -18px rgba(0, 0, 0, 0.19);
}

.image img:nth-child(2){
    position: absolute;
    top: -10%;
    right: 0;
}

@media screen and (max-width: 850px){
    .destination{
        margin: 4rem 2rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .first-des{
        display: flex;
        flex-direction: column-reverse;
        margin-top: 2.5rem;
    }

    .first-des-reverse{
        display: flex;
        flex-direction: column-reverse;
        margin-top: 2.5rem;
    }
    
    .des-text{
        width: 100%;
    }

    .image{
        width: 100%;
        margin: 1.8rem 0;
    }

    .image img{
        height: 250px;
    }
}

</style>