<div class="form-container">
    <h1>Send a message to us!</h1>
    @if (session('success'))
    <div class="alert">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('contact.submit') }}" method="POST"> 
        @csrf 
        @error('name')
            <div class="text-danger">{{ $message }}</div>
        @enderror  
        <input type="text" name="name" placeholder="Name">
         @error('email')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        <input type="email" name="email" placeholder="E-mail">
        @error('subject')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        <input type="text" name="subject" placeholder="Subject">
        @error('message')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        <textarea name="message" placeholder="Message" rows="4"></textarea>
        <button type="submit">Send Message</button>
    </form>
</div>

<style>
.form-container{
    margin: 4rem 6rem;
    columns: #2a2a2a;
}
.form-container h1{
    text-align: center;
    font-size: 2rem;
}

.alert{
    text-align: center;
    font-size: 1.2rem;
    color:red;
}

.form-container form{
    padding-top: 3rem;
    display: flex;
    flex-direction: column;
    width: 50%;
    margin: auto;
}

.form-container input{
    height: 3rem;
    padding: 0 1rem;
    margin-bottom: 2rem;
    border-radius: .3rem;
    border: 1px solid #2a2a2a;
}

.form-container textarea{
    padding: 0 1rem;
    margin-bottom: 2rem;
    border-radius: .3rem;
    border: 1px solid #2a2a2a;
}

.form-container button{
    display: inline;
    padding: 0.5rem 1rem;
    white-space: nowrap;
    border: solid;
    border-radius: 0.3rem;
    font-size: 1.2rem;
    font-weight: 600;
    cursor: pointer;
    transition: 0.2s ease-in-out;
}

@media screen  and (max-width:850px){
    .form-container{
        margin: 4rem 2rem;
    }

    .form-container form{
        padding-top: 2rem;
        width: 90%;
    }
}
</style>