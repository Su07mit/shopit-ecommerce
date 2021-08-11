<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ShopIt</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <style>
        .top-slider img{
            height: 400px;
            width: 100%;
            object-fit: cover ;
        }

        #ui-link li a{
            color: black;
        }
    </style>
</head>
<body>
    <header>
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light shadow-sm" style="background-color: #e3f2fd;">
                <div class="container">
                    <a class="navbar-brand mr-5 text-muted"  href="{{ url('/') }}" style="font-weight: bold">
                        ShopIt
                    </a>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        
                        <form class="d-flex" action="{{route('search')}}">
                        <input class="form-control me-2" type="search" placeholder="Search" name="search" aria-label="Search">
                        <button class="btn bg-info" type="submit">
                            <i class="fas fa-fw fa-search"></i>
                        </button>
                        </form>
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
                            
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                            @if (Route::has('login'))
                            <li class="navbar nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @endif

                            @if (Route::has('register'))
                            <li class="navbar nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                            @endif
                            @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            @endguest

                            <li class="navbar">
                                <a href="" class="btn ">
                                    <i class="fas fa-fw fa-shopping-cart mr-1"></i>               
                                    Cart      
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
            </nav>
        </div>

        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container bg-primary">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarText">
                        <ul class="navbar-nav me-auto fs-3 mb-2 mb-lg-0">
                            <li class="nav-item fs-1">
                            <a class="nav-link text-dark" aria-current="page" href="#">Electronics</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link text-dark" href="#">Groceries</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link text-dark" href="#">Fashion</a>
                            </li>
                        </ul>

                        <ul class="navbar-nav ml-auto me-auto fs-3 mb-2 mb-lg-0">
                            <li class="nav-item fs-1">
                            <a class="nav-link text-dark" aria-current="page" href="#">All Categories</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main>
        {{-- Carousel start --}}
        
        
        {{-- Carousel ends --}}

            <div class="container mt-4">
            <div class="row">
            {{-- Product --}}
            @foreach ($products as $product )
            <div class="col-3 mb-4">
                
                    <div class="card">
                        <div>
                            @if ($product->media_id)
                                <img src="{{ $product->image }}" style="max-width: 100%; height:250px; object-fit:cover" class="card-img-top" alt="Product Image">
                            @endif
                        </div>
                        <div class="card-body">
                            <h4 class="card-title font-weight-bold">
                                <a href="{{ route('product',$product->id) }}"> 
                                    {{ $product->name }} 
                                </a>
                            </h4>
                            <h5>${{ $product->price }}</h5>
                            <p class="card-text"> 
                                {{ Str::limit(strip_tags($product->description),100) }} 
                            </p>
                            <a href="{{ route('product',$product->id) }}" class="btn btn-primary d-flex justify-content-center">Product Details</a>
                        </div>                                                 
                    </div>
                
                
            </div>
            @endforeach
            {{-- Product ends --}}
        </div>
    </div>
    </main>

    
    {{-- footer --}}
    
        <footer class="footer" style="background-color: #e3f2fd;" >
            <div class="container pt-4">
                <div class="row">
                    <div class="col-3">
                        <h6 class="font-weight-bold">Get To Know Us</h6>
                        <ul class = "list-unstyled" id="ui-link">
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Our Company</a></li>
                            <li><a href="#">Jobs</a></li>
                            <li><a href="#">Customer Reviews</a></li>
                        </ul>
                    </div>

                    <div class="col-3">
                        <h6 class="font-weight-bold">Connect With Us</h6>
                        <ul class = "list-unstyled" id="ui-link">
                            <li><a href="#">Facebook</a></li>
                            <li><a href="#">Twitter</a></li>
                            <li><a href="#">Instagram</a></li>
                        </ul>
                    </div>

                    <div class="col-3">
                        <h6 class="font-weight-bold">How Can We Help</h6>
                        <ul class = "list-unstyled" id="ui-link">
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">Help and FAQs</a></li>
                            <li><a href="#">Your Account</a></li>
                        </ul>
                    </div>

                    <div class="col-3">
                        <h6 class="font-weight-bold">Shopping With Us</h6>
                        <ul class = "list-unstyled" id="ui-link">
                            <li><a href="#">Terms and Conditions</a></li>
                            <li><a href="#">Delivery Locations</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Refund Policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    
    {{-- footer ends --}}

   

    <script src="https://kit.fontawesome.com/de0fd40629.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>