
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Studio - ODDROOM</title>

    <style>
        :root {
            --cream: #F5EBD7;
            --green: #244C3A;
            --yellow: #F2C94C;
            --pink: #F28C8C;
            --blue: #8BB8D9;
            --black: #171714;
            --white: #FFFCF5;
            --muted: #77766D;
            --border: 2px solid var(--black);
            --shadow: 5px 5px 0 var(--black);
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: var(--cream);
            color: var(--black);
            font-family: Arial, Helvetica, sans-serif;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button,
        input,
        textarea {
            font: inherit;
        }

        .sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            width: 235px;
            padding: 30px 20px;
            background: var(--green);
            color: var(--cream);
            border-right: var(--border);
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            z-index: 5;
        }

        .brand {
            display: inline-block;
            font-size: 27px;
            font-weight: 1000;
            letter-spacing: -1.5px;
        }

        .brand span {
            color: var(--yellow);
            font-size: 13px;
            vertical-align: top;
        }

        .brand-note {
            color: #C9D7CB;
            font-size: 10px;
            letter-spacing: 1.5px;
            line-height: 1.7;
            margin: 7px 0 42px;
        }

        .menu-label {
            margin: 0 0 12px 10px;
            color: #B7C8BA;
            font-size: 10px;
            letter-spacing: 2px;
            font-weight: 800;
        }

        .menu {
            display: grid;
            gap: 8px;
        }

        .menu a {
            display: block;
            padding: 13px 11px;
            border: 2px solid transparent;
            border-radius: 7px;
            font-size: 12px;
            font-weight: 800;
            transition: .2s;
        }

        .menu a:hover,
        .menu a.active {
            background: var(--yellow);
            color: var(--black);
            border-color: var(--black);
            box-shadow: 3px 3px 0 var(--black);
            transform: translate(-1px, -1px);
        }

        .menu-icon {
            display: inline-block;
            width: 27px;
            font-size: 16px;
        }

        .sidebar-bottom {
            margin-top: auto;
            padding-top: 35px;
        }

        .profile {
            border-top: 1px solid #64806D;
            padding-top: 17px;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .avatar {
            width: 38px;
            height: 38px;
            flex-shrink: 0;
            display: grid;
            place-items: center;
            background: var(--pink);
            color: var(--black);
            border: var(--border);
            font-weight: 900;
        }

        .profile-name {
            font-size: 12px;
            font-weight: 800;
            overflow-wrap: anywhere;
        }

        .profile-role {
            font-size: 10px;
            color: #C9D7CB;
            margin-top: 4px;
        }

        .logout {
            width: 100%;
            background: transparent;
            border: 1px solid #9BB09E;
            color: var(--cream);
            padding: 11px;
            cursor: pointer;
            text-align: left;
            font-size: 12px;
            font-weight: 800;
            border-radius: 6px;
        }

        .logout:hover {
            background: var(--pink);
            color: var(--black);
            border-color: var(--black);
        }

        .main {
            margin-left: 235px;
            padding: 34px 38px 45px;
            min-height: 100vh;
            min-width: 0;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-bottom: 38px;
        }

        .breadcrumb {
            color: var(--muted);
            font-size: 10px;
            font-weight: 900;
            letter-spacing: 1.5px;
        }

        .top-tag {
            padding: 9px 12px;
            background: var(--white);
            border: var(--border);
            box-shadow: 3px 3px 0 var(--black);
            font-size: 10px;
            font-weight: 900;
            white-space: nowrap;
        }

        .heading {
            margin-bottom: 30px;
        }

        .eyebrow {
            font-size: 10px;
            font-weight: 900;
            letter-spacing: 3px;
            margin: 0 0 12px;
        }

        h1 {
            margin: 0;
            font-size: clamp(38px, 5vw, 60px);
            line-height: .98;
            letter-spacing: -3px;
            font-weight: 1000;
        }

        h1 span {
            color: var(--green);
        }

        .subtitle {
            color: #65645B;
            font-size: 12px;
            line-height: 1.7;
            margin-top: 14px;
        }

        .back-button {
            display: inline-block;
            margin-bottom: 22px;
            font-size: 11px;
            font-weight: 900;
            text-decoration: underline;
        }

        .form-card {
            max-width: 850px;
            background: var(--white);
            border: var(--border);
            box-shadow: var(--shadow);
            padding: 28px;
        }

        .form-heading {
            margin-bottom: 25px;
            padding-bottom: 17px;
            border-bottom: 2px solid #E2DACA;
        }

        .form-heading h2 {
            margin: 0;
            font-size: 19px;
            letter-spacing: -.5px;
        }

        .form-heading p {
            color: var(--muted);
            font-size: 11px;
            line-height: 1.6;
            margin: 8px 0 0;
        }

        .form-group {
            margin-bottom: 23px;
        }

        .form-group label {
            display: block;
            margin-bottom: 9px;
            font-size: 11px;
            font-weight: 900;
            letter-spacing: .7px;
        }

        .required {
            color: #C73535;
        }

        .form-control {
            width: 100%;
            padding: 13px 14px;
            border: 1.5px solid var(--black);
            background: #FFFCF5;
            color: var(--black);
            outline: none;
            font-size: 12px;
        }

        .form-control:focus {
            box-shadow: 3px 3px 0 var(--yellow);
            border-color: var(--green);
        }

        textarea.form-control {
            min-height: 130px;
            resize: vertical;
            line-height: 1.7;
        }

        .helper {
            display: block;
            margin-top: 8px;
            color: var(--muted);
            font-size: 10px;
            line-height: 1.6;
        }

        .upload-area {
            padding: 28px 20px;
            background: #F5EBD7;
            border: 2px dashed var(--green);
            text-align: center;
            cursor: pointer;
            transition: .2s;
        }

        .upload-area:hover,
        .upload-area.dragover {
            background: #E7F0E7;
            border-color: var(--black);
        }

        .upload-icon {
            font-size: 35px;
            margin-bottom: 10px;
        }

        .upload-title {
            font-size: 13px;
            font-weight: 900;
            margin-bottom: 7px;
        }

        .upload-description {
            color: var(--muted);
            font-size: 10px;
            line-height: 1.6;
        }

        .upload-area input {
            display: none;
        }

        .preview-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            margin: 20px 0 12px;
            font-size: 11px;
            font-weight: 900;
        }

        .preview-count {
            color: var(--muted);
            font-size: 10px;
        }

        .preview-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(130px, 1fr));
            gap: 12px;
        }

        .preview-item {
            position: relative;
            height: 125px;
            border: 1.5px solid var(--black);
            background: #E2DACA;
            overflow: hidden;
        }

        .preview-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .preview-item button {
            position: absolute;
            top: 6px;
            right: 6px;
            width: 25px;
            height: 25px;
            border: 1.5px solid var(--black);
            background: var(--pink);
            font-weight: 900;
            cursor: pointer;
        }

        .preview-name {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 6px;
            background: rgba(23, 23, 20, .8);
            color: white;
            font-size: 9px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .notice {
            padding: 13px 15px;
            margin-bottom: 20px;
            border: var(--border);
            background: #FFE0DC;
            font-size: 11px;
            font-weight: 700;
            line-height: 1.6;
        }

        .notice ul {
            padding-left: 20px;
            margin: 7px 0 0;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            flex-wrap: wrap;
            padding-top: 20px;
            margin-top: 25px;
            border-top: 1px solid #E2DACA;
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 13px 19px;
            border: var(--border);
            box-shadow: 4px 4px 0 var(--black);
            font-size: 11px;
            font-weight: 900;
            cursor: pointer;
            transition: .18s;
        }

        .button:hover {
            transform: translate(-2px, -2px);
            box-shadow: 6px 6px 0 var(--black);
        }

        .button-cancel {
            background: var(--pink);
        }

        .button-submit {
            background: var(--yellow);
        }

        .footer {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            margin-top: 38px;
            padding-top: 18px;
            border-top: 1px solid #CFC5B2;
            color: var(--muted);
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .7px;
        }

        @media (max-width: 650px) {
            .sidebar {
                width: 190px;
                padding: 22px 12px;
            }

            .brand {
                font-size: 23px;
            }

            .brand-note {
                font-size: 9px;
                margin-bottom: 25px;
            }

            .menu a {
                padding: 12px 8px;
                font-size: 11px;
            }

            .main {
                margin-left: 190px;
                padding: 24px 15px;
            }

            .topbar {
                align-items: flex-start;
                flex-direction: column;
                margin-bottom: 28px;
            }

            h1 {
                font-size: clamp(28px, 7vw, 42px);
                letter-spacing: -2px;
            }

            .form-card {
                padding: 17px;
            }

            .form-actions {
                flex-direction: column;
            }

            .button {
                width: 100%;
            }

            .footer {
                flex-direction: column;
            }
        }

        @media (max-width: 380px) {
            .sidebar {
                width: 155px;
                padding: 18px 9px;
            }

            .brand {
                font-size: 20px;
            }

            .brand-note {
                font-size: 8px;
            }

            .menu a {
                font-size: 10px;
                padding: 10px 5px;
            }

            .main {
                margin-left: 155px;
                padding: 20px 10px;
            }

            .form-card {
                padding: 12px;
            }
        }
    </style>
</head>

<body>

<aside class="sidebar">
    <a href="/admin" class="brand">ODDROOM<span>®</span></a>
    <div class="brand-note">MUSIC STUDIO MANAGEMENT</div>

    <div class="menu-label">WORKSPACE</div>

    <nav class="menu">
        <a href="/admin">
            <span class="menu-icon">▦</span> Dashboard
        </a>

        <a href="/admin/studios" class="active">
            <span class="menu-icon">♫</span> Kelola Studio
        </a>

        <a href="/admin/payments">
            <span class="menu-icon">▣</span> Payments
        </a>

        <a href="/admin/users">
            <span class="menu-icon">♟</span> User Control
        </a>
    </nav>

    <div class="sidebar-bottom">
        <div class="profile">
            <div class="avatar">O</div>
            <div>
                <div class="profile-name">
                    {{ auth()->user()->name ?? 'Administrator' }}
                </div>
                <div class="profile-role">ODDROOM ADMIN</div>
            </div>
        </div>

        <form action="/logout" method="POST">
            @csrf
            <button type="submit" class="logout">↗ &nbsp; LOG OUT</button>
        </form>
    </div>
</aside>

<main class="main">

    <div class="topbar">
        <div class="breadcrumb">ODDROOM / ADMIN / STUDIOS / CREATE</div>
        <div class="top-tag">♫ NEW STUDIO</div>
    </div>

    <a href="/admin/studios" class="back-button">
        ← BACK TO STUDIO COLLECTION
    </a>

    <header class="heading">
        <p class="eyebrow">BUILD YOUR NEXT SOUND SPACE.</p>
        <h1>MAKE A<br><span>NEW ROOM.</span></h1>
        <p class="subtitle">
            Add a new studio and upload its photos.<br>
            Make every room ready for a new session.
        </p>
    </header>

    @if ($errors->any())
        <div class="notice">
            Please check the following:
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section class="form-card">

        <div class="form-heading">
            <h2>STUDIO INFORMATION</h2>
            <p>Fill in the studio details before saving.</p>
        </div>

        <form
            action="/admin/studios"
            method="POST"
            enctype="multipart/form-data"
            id="studioForm"
        >
            @csrf

            <div class="form-group">
                <label for="name">
                    NAMA STUDIO <span class="required">*</span>
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    class="form-control"
                    value="{{ old('name') }}"
                    placeholder="Contoh: Band Room"
                    required
                >
            </div>

            <div class="form-group">
                <label for="description">
                    DESKRIPSI <span class="required">*</span>
                </label>

                <textarea
                    id="description"
                    name="description"
                    class="form-control"
                    placeholder="Jelaskan fasilitas dan suasana studio..."
                    required
                >{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label for="price_per_hour">
                    HARGA PER JAM (RUPIAH)
                    <span class="required">*</span>
                </label>

                <input
                    type="number"
                    id="price_per_hour"
                    name="price_per_hour"
                    class="form-control"
                    min="0"
                    step="1000"
                    value="{{ old('price_per_hour') }}"
                    placeholder="Contoh: 150000"
                    required
                >
            </div>

            <div class="form-group">
                <label>
                    STUDIO PHOTOS <span class="required">*</span>
                </label>

                <label for="images" class="upload-area" id="uploadArea">
                    <div class="upload-icon">♫</div>
                    <div class="upload-title">CLICK TO UPLOAD PHOTOS</div>
                    <div class="upload-description">
                        Pilih satu atau beberapa foto sekaligus.<br>
                        JPG, JPEG, PNG, WEBP · Maksimal 5 MB per foto.
                    </div>

                    <input
                        type="file"
                        id="images"
                        name="images[]"
                        accept=".jpg,.jpeg,.png,.webp"
                        multiple
                        required
                    >
                </label>

                <div class="preview-heading">
                    <span>PHOTO PREVIEW</span>
                    <span class="preview-count" id="previewCount">
                        0 photos selected
                    </span>
                </div>

                <div class="preview-grid" id="previewGrid"></div>

                <small class="helper">
                    Foto pertama yang dipilih akan menjadi gambar utama studio.
                </small>
            </div>

            <div class="form-actions">
                <a href="/admin/studios" class="button button-cancel">
                    CANCEL
                </a>

                <button type="submit" class="button button-submit">
                    SAVE STUDIO ↗
                </button>
            </div>

        </form>
    </section>

    <footer class="footer">
        <span>ODDROOM® — YOUR SPACE. YOUR SOUND.</span>
        <span>ADMIN CONTROL ROOM · CREATE STUDIO.</span>
    </footer>

</main>

<script>
    const imageInput = document.getElementById('images');
    const previewGrid = document.getElementById('previewGrid');
    const previewCount = document.getElementById('previewCount');
    const uploadArea = document.getElementById('uploadArea');

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

        previewCount.textContent =
            selectedFiles.length + ' photos selected';

        selectedFiles.forEach((file, index) => {
            const reader = new FileReader();

            reader.onload = function(event) {
                const item = document.createElement('div');
                item.className = 'preview-item';

                const img = document.createElement('img');
                img.src = event.target.result;
                img.alt = 'Studio photo preview';

                const removeButton = document.createElement('button');
                removeButton.type = 'button';
                removeButton.textContent = '×';
                removeButton.title = 'Remove photo';

                removeButton.addEventListener('click', function() {
                    selectedFiles.splice(index, 1);
                    updateFileInput();
                });

                const filename = document.createElement('div');
                filename.className = 'preview-name';
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
        const newFiles = Array.from(this.files);

        selectedFiles = [...selectedFiles, ...newFiles];

        updateFileInput();
    });

    uploadArea.addEventListener('dragover', function(event) {
        event.preventDefault();
        uploadArea.classList.add('dragover');
    });

    uploadArea.addEventListener('dragleave', function() {
        uploadArea.classList.remove('dragover');
    });

    uploadArea.addEventListener('drop', function(event) {
        event.preventDefault();
        uploadArea.classList.remove('dragover');

        const droppedFiles = Array.from(event.dataTransfer.files)
            .filter(file => file.type.startsWith('image/'));

        selectedFiles = [...selectedFiles, ...droppedFiles];

        updateFileInput();
    });
</script>

</body>
</html>
