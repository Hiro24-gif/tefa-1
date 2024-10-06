<head>
    @include('components.head')
    <style>
        .card {
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .img-container {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .content {
            min-height: 80vh;
            padding-bottom: 20px;
        }
        footer {
            position: relative;
            bottom: 0;
            width: 100%;
        }
        .navbar {
            position: relative;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    @include('components.navbar')

    <!-- Detail Produk Utama -->
    <div class="container mt-5 content">
        <div class="card p-4">
            <div class="row align-items-center">
                <div class="col-md-4 mb-4 mb-md-0 img-container">
                    <img src="{{ asset('storage/' . $productDetail->image) }}" alt="{{ $productDetail->name }}" class="img-fluid">
                </div>

                <div class="col-md-8">
                    <table class="table table-striped table-hover">
                        <tbody>
                            <tr>
                                <td><strong>Model:</strong></td>
                                <td>{{ $productDetail->name }}</td>
                            </tr>
                            <tr>
                                <td><strong>WIRE :</strong></td>
                                <td>{{ $productDetail->Wire }}</td>
                            </tr>
                            <tr>
                                <td><strong>OUTSIDE:</strong></td>
                                <td>{{ $productDetail->Outside }}</td>
                            </tr>
                            <tr>
                                <td><strong>FREE HEIGHT:</strong></td>
                                <td>{{ $productDetail->Free_height }}</td>
                            </tr>
                            <tr>
                                <td><strong>SOLID HEIGHT:</strong></td>
                                <td>{{ $productDetail->Solid_height }}</td>
                            </tr>
                            <tr>
                                <td><strong>SPRING RATE:</strong></td>
                                <td>{{ $productDetail->Spring_rate }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Produk Lain di Kategori yang Sama -->
    <div class="container">
        <h2 class="mt-5">Produk Lain di Kategori yang Sama</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4 py-5">
            @foreach($relatedProducts as $product)
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <a href="{{ route('detail', $product->id) }}" class="btn btn-primary">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <footer class="bg-light py-3">
        @include('components.footer')
    </footer>
</body>
