@extends('layouts.user.main')
@section('content')
<!-- start banner Area -->
<section class="banner-area">
    <div class="container">
        <div class="row fullscreen align-items-center justify-content-start">
            <div class="col-lg-12">
                <div class="">
                    <!-- single-slide -->
                    <div class="row">
                        <div class="col-lg-5 col-md-6">
                            <div class="banner-content">
                                <h1>Nike New <br>Collection!</h1>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="banner-img">
                                <img class="img-fluid" src="{{ asset('assets/templates/user/img/banner/banner-img.png') }}" alt="">
                            </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End banner Area -->

<!-- start product Area -->
<section class="section_gap">
    <!-- single product slide -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <div class="section-title">
                    <h1>Latest Products</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- single product -->
            @forelse ($products as $product)
                <div class="col-lg-3 col-md-6">
                    <div class="single-product">
                    <img class="img-fluid" src="{{ asset('images/' . $product->image) }}" alt="">
                        <div class="product-details">
                            <h6>{{ $product->name }}</h6>
                            <div class="price">
                                <h6>Harga: {{ $product->price }} Points</h6>
                            </div>
                            <div class="prd-bottom">
                                @auth
                                    <a class="social-info" href="javascript:void(0);" onclick="confirmPurchase('{{ $product->id }}', '{{ Auth::user()->id }}')">
                                        <span class="ti-bag"></span>
                                        <p class="hover-text">Beli</p>
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="social-info">
                                        <span class="ti-bag"></span>
                                        <p class="hover-text">Login untuk Beli</p>
                                    </a>
                                @endauth
                                <a href="{{ route('user.detail.product', $product->id) }}" class="social-info">
                                    <span class="lnr lnr-move"></span>
                                    <p class="hover-text">Detail</p>
                                </a>
                            </div>
                        </div>
                    </div>
                    </div>
            @empty
                <div class="col-lg-12 col-md-12">
                    <div class="single-product">
                        <h3 class="text-center">Tidak ada produk</h3>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>
<!-- end product Area -->

<!-- Start Product Sale Area -->
<section class="section_gap">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <div class="section-title">
                    <h1>Produk Sale</h1>
                    <p>Produk dengan harga khusus!</p>
                </div>
            </div>
        </div>
        <div class="row">
            @forelse ($products as $product)
                <div class="col-lg-3 col-md-6">
                    <div class="single-product">
                        <img class="img-fluid" src="{{ asset('images/' . $product->image) }}" alt="">
                        <div class="product-details">
                            <h6>{{ $product->name }}</h6>
                            <div class="price">
                                <h6>Harga: {{ $product->sale_price }} Points</h6>
                                <del>{{ $product->price }} Points</del>
                            </div>
                            <div class="prd-bottom">
                                @auth
                                    <a class="social-info" href="javascript:void(0);" onclick="confirmPurchase('{{ $product->id }}', '{{ Auth::user()->id }}')">
                                        <span class="ti-bag"></span>
                                        <p class="hover-text">Beli</p>
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="social-info">
                                        <span class="ti-bag"></span>
                                        <p class="hover-text">Login untuk Beli</p>
                                    </a>
                                @endauth
                                <a href="{{ route('user.detail.product', $product->id) }}" class="social-info">
                                    <span class="lnr lnr-move"></span>
                                    <p class="hover-text">Detail</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-lg-12 col-md-12">
                    <div class="single-product">
                        <h3 class="text-center">Tidak ada produk sale</h3>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>
<!-- end Product Sale Area -->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmPurchase(productId, userId) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda akan membeli produk ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Beli!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '{{ url("/product/purchase") }}/' + productId + '/' + userId;
            }
        });
    }
</script>
@endsection



