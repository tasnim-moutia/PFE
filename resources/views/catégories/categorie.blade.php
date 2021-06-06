@extends('layouts.app')
@extends('layouts.script')

@section('content')
<style>
        .menu {
    padding: 0;
    
    & > * {
        display: inline;
        
        &:after {
        content: ',';
        }
        
        &:last-child:after {
        content: '';
        }
    }
    }
    /*a:hover {
    text-decoration: underline;
    }*/
    .dot {
        height: 7px;
        width:7px;
        background-color: rgb(59, 52, 52);
        border-radius: 50%;
        display: inline-block;
    }
  .dot:hover{
        color: #e65540;
    }
</style>
<!-- Banner -->
<section class="banner bgwhite p-t-40 p-b-40">
    <div class="container">
            <div class="col-sm-10 col-md-8 col-lg-6 ">
                <!-- block1 -->
                <h1>Catégories</h1>
                <br>
                <div class="flex-m inline-block">
                 <div class="col-lg-9">   
                    <ul class="menu">
                        @foreach ($categories->take(5) as $item)
                            <li>
                                <a href="#" class="fs-18 color2 mt-3"><span class="dot"></span>&Tab;{{$item->nom_categorie}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>  
                <div class="col-lg-9"> 
                    <ul class="menu">
                        @foreach ($categories->slice(5) as $item)
                            <li>
                                <a href="#" class="fs-18 color2 mt-3"><span class="dot"></span>&Tab;{{$item->nom_categorie}}</a>
                            </li>
                        @endforeach
                    </ul> 
                </div>    
            </div>   

    </div>
</section>
@endsection