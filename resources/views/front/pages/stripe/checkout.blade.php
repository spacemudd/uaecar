<html>
    <head>
        
    </head>



    <body>
        
    <form action="{{ route('test') }}" method="POST">


    @csrf
    <button type="submit">Checkout</button>
    </form>



    </body>
</html>