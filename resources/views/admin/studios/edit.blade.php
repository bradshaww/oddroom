
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Studio - ODDROOM</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 30px;
            background: #F5EBD7;
            color: #171714;
            font-family: Arial, Helvetica, sans-serif;
        }

        .container {
            max-width: 850px;
            margin: auto;
        }

        h1 {
            font-size: 35px;
            margin-bottom: 10px;
        }

        .back {
            display: inline-block;
            margin: 12px 0 25px;
            color: #244C3A;
            font-weight: bold;
        }

        .form-card {
            padding: 25px;
            background: #FFFCF5;
            border: 2px solid #171714;
            box-shadow: 5px 5px 0 #171714;
        }

        .form-group {
            margin-bottom: 22px;
        }

        label {
            display: block;
            margin-bottom: 9px;
            font-size: 13px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 12px;
            border: 1.5px solid #171714;
            background: #FFFCF5;
            font-size: 13px;
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        input:focus,
        textarea:focus {
            outline: 2px solid #F2C94C;
        }

        .section-title {
            margin-bottom: 12px;
            font-size: 16px;
            font-weight: bold;
        }

        .photo-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(145px, 1fr));
            gap: 15px;
        }

        .photo-card {
            border: 1.5px solid #171714;
            background: #F5EBD7;
            overflow: hidden;
        }

        .photo-card img {
            display: block;
            width: 100%;
            height: 130px;
            object-fit: cover;
        }

        .photo-info {
            padding: 10px;
        }

        .photo-name {
            font-size: 11px;
            font-weight: bold;
            overflow-wrap: anywhere;
            margin-bottom: 10px;
        }

        .delete-option {
            display: flex;
            align-items: center;
            gap: 7px;
            font-size: 11px;
            color: #A52D2D;
            cursor: pointer;
        }

        .delete-option input {
            width: 15px;
            height: 15px;
            accent-color: #F28C8C;
        }

        .upload-box {
            padding: 20px;
            border: 2px dashed #244C3A;
            background: #F5EBD7;
            text-align: center;
        }

        .upload-box input {
            max-width: 100%;
            margin-top: 12px;
        }

        .helper {
            display: block;
            margin-top: 9px;
            color: #77766D;
            font-size: 11px;
            line-height: 1.6;
        }

        .preview-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 12px;
            margin-top: 15px;
        }

        .preview-item {
            position: relative;
            height: 120px;
            border: 1.5px solid #171714;
            overflow: hidden;
        }

        .preview-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .preview-item button {
            position: absolute;
            top: 5px;
            right: 5px;
            width: 25px;
            height: 25px;
            border: 1px solid #171714;
            background: #F28C8C;
            font-weight: bold;
            cursor: pointer;
        }

        .preview-item span {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 5px;
            background: rgba(23, 23, 20, .8);
            color: white;
            font-size: 9px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .error-box {
            margin-bottom: 20px;
            padding: 12px 18px;
            border: 1.5px solid #A52D2D;
            background: #FFE0DC;
            color: #A52D2D;
            font-size: 12px;
        }

        .actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #D8CEBD;
        }

        .button {
            display: inline-block;
            padding: 12px 18px;
            border: 2px solid #171714;
            box-shadow: 3px 3px 0 #171714;
            color: #171714;
            font-size: 12px;
            font-weight: bold;
            text-decoration: none;
            cursor: pointer;
        }

        .button-back {
            background: #F28C8C;
        }

        .button-save {
            background: #F2C94C;
        }

        .button:hover {
            transform: translate(-1px, -1px);
            box-shadow: 4px 4px 0 #171714;
        }

        @media (max-width: 550px) {
            body {
                padding: 18px;
            }

            .form-card {
                padding: 17px;
            }

            .actions {
                flex-direction: column;
            }

            .button {
                text-align: center;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Edit Studio</h1>

    <p>Perbarui informasi studio dan kelola foto studio.</p>

    <a href="/admin/studios" class="back">
        ← Kembali ke Daftar Studio
    </a>

    @if ($errors->any())
        <div class="error-box">
            <strong>Terjadi kesalahan:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-card">

        <form
            action="/admin/studios/{{ $studio->studio_id }}"
            method="POST"
            enctype="multipart/form-data"
            id="editStudioForm"
        >
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Nama Studio</label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name', $studio->name) }}"
                    required
                >
            </div>

            <div class="form-group">
                <label for="description">Deskripsi</label>

                <textarea
                    id="description"
                    name="description"
                    required
                >{{ old('description', $studio->description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="price_per_hour">
                    Harga per Jam (Rupiah)
                </label>

                <input
                    type="number"
                    id="price_per_hour"
                    name="price_per_hour"
                    min="0"
                    step="1000"
                    value="{{ old('price_per_hour', $studio->price_per_hour) }}"
                    required
                >
            </div>

            <div class="form-group">

                <div class="section-title">Foto Studio Saat Ini</div>

                @if ($studioImages->count() > 0)

                    <p class="helper">
                        Centang foto yang ingin dihapus. Foto yang tidak dicentang akan tetap tersimpan.
                    </p>

                    <div class="photo-grid">

                        @foreach ($studioImages as $image)

                            <div class="photo-card">

                                <img
                                    src="{{ asset('images/' . $image->image_path) }}"
                                    alt="Foto {{ $studio->name }}"
                                >

                                <div class="photo-info">

                                    <div class="photo-name">
                                        {{ $image->image_path }}
                                    </div>

                                    <label class="delete-option">
                                        <input
                                            type="checkbox"
                                            name="delete_images[]"
                                            value="{{ $image->studio_image_id }}"
                                            {{ in_array($image->studio_image_id, old('delete_images', [])) ? 'checked' : '' }}
                                        >

                                        Hapus foto ini
                                    </label>

                                </div>

                            </div>

                        @endforeach

                    </div>

                @else

                    <p class="helper">
                        Studio ini belum memiliki foto.
                    </p>

                @endif

            </div>

            <div class="form-group">

                <label for="images">Tambah Foto Baru</label>

                <div class="upload-box">

                    <strong>Pilih Foto Studio</strong>

                    <br>

                    <input
                        type="file"
                        id="images"
                        name="images[]"
                        accept=".jpg,.jpeg,.png,.webp"
                        multiple
                    >

                    <small class="helper">
                        Bisa memilih beberapa foto sekaligus.
                        Format JPG, JPEG, PNG, atau WEBP.
                        Maksimal 5 MB per foto.
                    </small>

                </div>

                <div id="previewGrid" class="preview-grid"></div>

            </div>

            <div class="actions">

                <a href="/admin/studios" class="button button-back">
                    Batal
                </a>

                <button type="submit" class="button button-save">
                    Simpan Perubahan
                </button>

            </div>

        </form>

    </div>

</div>

<script>
    const imageInput = document.getElementById('images');
    const previewGrid = document.getElementById('previewGrid');

    let selectedFiles = [];

    function updateFileInput() {
        const dataTransfer = new DataTransfer();

        selectedFiles.forEach(file => {
            dataTransfer.items.add(file);
        });

        imageInput.files = dataTransfer.files;

        renderPreview();
    }

    function renderPreview() {
        previewGrid.innerHTML = '';

        selectedFiles.forEach((file, index) => {
            const reader = new FileReader();

            reader.onload = function(event) {
                const item = document.createElement('div');
                item.className = 'preview-item';

                const img = document.createElement('img');
                img.src = event.target.result;
                img.alt = 'Preview foto baru';

                const removeButton = document.createElement('button');
                removeButton.type = 'button';
                removeButton.textContent = '×';
                removeButton.title = 'Batalkan foto ini';

                removeButton.addEventListener('click', function() {
                    selectedFiles.splice(index, 1);
                    updateFileInput();
                });

                const filename = document.createElement('span');
                filename.textContent = file.name;

                item.appendChild(img);
                item.appendChild(removeButton);
                item.appendChild(filename);

                previewGrid.appendChild(item);
            };

            reader.readAsDataURL(file);
        });
    }

    imageInput.addEventListener('change', function() {
        selectedFiles = Array.from(this.files);
        updateFileInput();
    });

    document.getElementById('editStudioForm')
        .addEventListener('submit', function(event) {
            const deleteCount = document.querySelectorAll(
                'input[name="delete_images[]"]:checked'
            ).length;

            if (deleteCount > 0) {
                const confirmed = confirm(
                    'Yakin ingin menghapus ' +
                    deleteCount +
                    ' foto yang dipilih?'
                );

                if (!confirmed) {
                    event.preventDefault();
                }
            }
        });
</script>

</body>
</html>
