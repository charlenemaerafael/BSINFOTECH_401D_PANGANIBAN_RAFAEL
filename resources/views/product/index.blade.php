<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Nunito', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }
    </style>
</head>
<body class="bg-[#fae0e4] font-sans min-h-screen flex flex-col items-center pt-2 mb-10">

    <header class="fixed top-0 left-0 w-full bg-gradient-to-r from-[#FF477E] via-[#FF7096] to-[#FF0A54] text-white font-black py-3 z-10 shadow-lg flex items-center px-6">
        <div class="flex items-center">
            <img src="{{ asset('storage/images/pink_logo.png') }}" alt="Logo" class="h-16 w-30 object-contain">
        </div>
        <h1 class="text-2xl sm:text-3xl flex-1 text-center" style="margin-left: -100px;">CharZeya's Product</h1>
    </header>
    
    
    <div class="container mx-auto px-4 text-center mt-20">
        <!-- Success Message -->
        @if (session('success'))
            <div class="mb-4 mt-4 bg-[#FF477E] text-white py-2 px-4 rounded-lg shadow-md">
                {{ session('success') }}
            </div>
        @endif

        <!-- Add New Products -->
        <div class="flex justify-end mb-6 mt-10">
            <a href="{{ route('product.create') }}" 
                class="bg-[#FF477E] text-white px-6 py-3 rounded-full shadow-lg font-extrabold hover:bg-pink-700 hover:text-white transition-all duration-300">
                ADD NEW
            </a>
        </div>

        <!-- Product Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($products as $item)
            <div class="bg-[#f7cad0] rounded-lg shadow-xl overflow-hidden transition-all transform hover:scale-105 hover:shadow-2xl">
                <a href="{{ route('product.show', $item->id) }}" class="block">
                    <div class="p-6">
                        
                        <!-- Product Name -->
                        <div class="text-pink-600 mb-4">
                            <p class="font-extrabold text-lg">{{ $item->product_name }}</p>
                        </div>

                        <!-- Product Image and Price -->
                        <div class="relative flex justify-center items-center mb-4">
                            <p class="absolute top-2 right-2 text-pink-600 font-bold text-xl bg-white px-2 py-1 rounded-lg shadow-md">
                                ₱{{ number_format($item->price, 2) }}
                            </p>
                            <img src="{{ asset($item->pic) }}" alt="Product Image" class="w-full h-full object-cover rounded-lg">
                        </div>

                        <!-- Description -->
                        <div class="text-pink-600 mb-4">
                            <p class="text-sm">{{ $item->description }}</p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</body>
</html>
