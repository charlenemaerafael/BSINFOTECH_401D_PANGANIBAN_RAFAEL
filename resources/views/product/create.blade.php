<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Nunito', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        }
        .file-input {
            display: none;
        }
    </style>
</head>
<body style="background-color: #fae0e4;" class="flex items-center justify-center min-h-screen w-full">

    <div class="absolute top-4 right-4">
        <a href="{{ route('product.index') }}" 
           class="bg-[#FF477E] text-white px-4 py-2 rounded-lg shadow-md font-extrabold hover:bg-pink-700 hover:text-white transition duration-300">
            BACK
        </a>
    </div>

    <div class="w-full h-full flex items-center justify-center px-4">
        <div class="bg-[#f7cad0] rounded-lg shadow-lg p-6 w-full max-w-3xl">
            <h2 style="color: #FF0A54;" class="text-2xl font-semibold mb-4 text-center">Create New Product</h2>

            <!-- Error Display -->
            @if ($errors->any())
                <div class="mb-4 bg-pink-700 text-white py-2 px-4 rounded-lg shadow-md">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Product Name -->
                <div class="mb-4">
                    <label for="product_name" style="color: #FF477E;" class="block text-left font-bold">Product Name</label> 
                    <input type="text" id="product_name" name="product_name" 
                           class="w-full px-4 py-2 rounded-lg border" style="border-color: #FF7096;" value="{{ old('product_name') }}" required>
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <label for="description" style="color: #FF477E;" class="block text-left font-bold">Description</label>
                    <textarea id="description" name="description" 
                              class="w-full px-4 py-2 rounded-lg border" style="border-color: #FF7096;" rows="4" required>{{ old('description') }}</textarea>
                </div>

                <!-- Product Price -->
                <div class="mb-4">
                    <label for="price" style="color: #FF477E;" class="block text-left font-bold">Price (₱)</label>
                    <input type="number" id="price" name="price" 
                        class="w-full px-4 py-2 rounded-lg border" style="border-color: #FF7096;" value="{{ old('price') }}" required step="0.01" min="0">
                </div>

                <!-- Product Image -->
                <div class="mb-4">
                    <label for="pic" style="color: #FF477E;" class="block text-left font-bold">Product Image</label>
                    <br>
                    <label for="pic" class="bg-[#FF477E] text-white px-4 py-2 rounded-lg cursor-pointer hover:bg-pink-700 font-bold">Choose File</label>
                    <input type="file" id="pic" name="pic" class="file-input" onchange="previewImage(event)" required>
                </div>

                <!-- Image Preview -->
                <div class="mb-4" id="image-preview-container" style="display: none;">
                    <img id="image-preview" class="w-48 h-48 object-contain mx-auto" />
                    <p class="text-sm text-pink-700 mt-2">Preview</p>
                </div>

                <!-- Create Product -->
                <div class="mb-4">
                    <button type="submit" class="bg-[#FF477E] text-white px-4 py-2 rounded-lg shadow hover:bg-pink-700 hover:text-white font-bold transition duration-300 w-full">
                        CREATE PRODUCT
                    </button>
                 </div>
            </form>
        </div>
    </div>
    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('image-preview');
                var previewContainer = document.getElementById('image-preview-container');
                output.src = reader.result;  
                previewContainer.style.display = 'block';  
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</body>
</html>
