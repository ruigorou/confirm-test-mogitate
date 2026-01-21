document.getElementById('image').addEventListener('change', function (e) {
    const file = e.target.files[0];
    if (!file) return;

    const fileName = document.getElementById('file-name');
    fileName.textContent = file.name;

    const reader = new FileReader();
    reader.onload = function (e) {
        document.getElementById('preview').src = e.target.result;
    };
    reader.readAsDataURL(file);
});
