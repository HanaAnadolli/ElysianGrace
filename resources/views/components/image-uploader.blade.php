<div {{ $attributes->merge(['class' => 'image-uploader']) }}>
    <label for="banner">Upload Image:</label>
    <input type="file" id="banner" name="banner" accept="image/*" onchange="updatePreview(this)">
    <img id="preview" style="width: 100%; max-width: 300px; display: none; margin-top: 10px;">

    <script>
        function updatePreview(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var previewElement = document.getElementById('preview');
                    previewElement.src = e.target.result;
                    previewElement.style.display = 'block';  // Show the preview
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        </script>

</div>
