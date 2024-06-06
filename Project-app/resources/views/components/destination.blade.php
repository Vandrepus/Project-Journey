<div class="destination">
    <h1>Popular Destinations by TripAdvisor</h1>
    <p>Discover Your Next Adventure: Where Every Destination Becomes a Favorite</p>
    
    <x-destination-data 
        class="first-des" 
        heading="Dubai"
        text="Everything feels extra spectacular in Dubai—from the ultra-modern Burj Khalifa to the souks and malls filled with gold and jewelry vendors. It’s a place where if you can dream it, you can do it: Whether that means skiing indoors, dune-surfing in the desert, or zip-lining above the city. But it’s not all glitz and adrenaline-pumping action. Stroll through the winding alleys of Al Fahidi Historical Neighborhood to see what Dubai was like during the mid-19th century. Or visit the Jumeirah Mosque (one of the few mosques open to non-Muslims) and learn about Emirati culture. Spot some street art on Jumeirah Beach Road and grab a bite at a shawarma shop, or spend the day hunting for spices and perfume then round things out with a Michelin-starred meal. You can really do it all and we’ve got more recs, below."
        img1="Dubai.jpg"
        img2="Dubai1.jpeg"
    />

    <x-destination-data 
        class="first-des-reverse" 
        heading="Bali"
        text="Bali packs a lot into one small island— from breathtaking waterfalls like Sekumpul in the north to the white sand beaches of Nyang Nyang in the south. Whatever you’re seeking, you’ll probably find: surf-able waves in Batu Bolong, all-night clubs in Seminyak, luxury clifftop hotels in Nusa Dua, and spiritual refuges all around. Snap a pic at the Gateway to Heaven, cut through the jungle to the hidden Gunung Kawi Temple, and catch the sunset and a traditional fire dance at Uluwatu Temple. Just don’t miss the markets—hunt for handcrafted artwork and textiles at the Sukawati Art Market, or snack on street food staples like satay and bakso at the Sindhu Night Market. For even more tastes and things to do, check out our recs below."
        img1="Bali.jpeg"
        img2="Bali1.jpg"
    />

    <x-destination-data 
        class="first-des" 
        heading="London"
        text="London’s a sprawling city at the center of everything: art, history, culture—you name it. But what sets it apart from other major hubs are its distinct neighborhoods, each with their own vibe. Spend an afternoon with the fam in Kensington: It’s got museums, parks, and plenty of other kid-approved things to do. Or check out edgy Shoreditch for cool shops and street murals (perfect for photo ops), then head to Soho where you can grab a pint at a pub or hit a club and party ‘til dawn. Food’s a big deal here: Yes, there’s fish and chips, but also next-level curry houses thanks to London’s thriving Bangladeshi community (take your pick from tons of spots on Brick Lane), plus a growing roster of celebrity chef-driven restaurants in posh Mayfair. There’s always something new going on and we’ve got more recs, below."
        img1="London.jpg"
        img2="London1.jpg"
    />

    <x-destination-data 
        class="first-des-reverse" 
        heading="Hanoi"
        text="Despite centuries of French and Chinese influence, Hanoi is a city that’s wholly (and proudly) Vietnamese. But its layered history is everywhere you look—from the Old Quarter with its French colonial buildings to the more than 600 temples and pagodas around the city. You can get right to the history of the city at sites like Hoa Lo Prison or the Ho Chi Minh Mausoleum. Take it all in by foot (or scooter), making time for detours at some of the city’s newer additions: independent art galleries, boutique shops, and trendy cafes. If you’re coming just for the food, you’re not alone. Banh mi and bun cha are obviously musts, but save room for other street food faves: crispy crepes, stir-fried eel, shrimp cakes, and a few frosty beers to wash it all down. For the best of what Hanoi has to offer, get even more recs below."
        img1="Hanoi.jpg"
        img2="Hanoi1.jpg"
    />

    <x-destination-data 
        class="first-des" 
        heading="Rome"
        text="It’s easy to see why Rome’s one of the most-visited places on the planet: There’s history everywhere (the Pantheon, the Colosseum, the list goes on), sculptural masterpieces in almost every piazza, and—of course—ridiculously good food. Every trip could feel like a whirlwind, but slow down and you’ll discover lots of surprises. Spend a Sunday morning in Trastevere and hunt for vintage finds at Porta Portese flea market. Or hit San Lorenzo—a student neighborhood with an edgy-but-charming vibe—for trendy shops, galleries, and street art. Dinner’s not ‘til late here, so grab an aperitivo in Prati—it’s walkable from the Vatican and packed with quirky sidestreet bars.Yes, the energy’s next-level, so if you need a break, head for the hills (literally) and check out Aventine Hill, a leafy-green suburb with peaceful gardens and some of the best views of the city. There’s always something to do and we’ve got more recs, below."
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