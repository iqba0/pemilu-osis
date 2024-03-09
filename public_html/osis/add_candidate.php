<!DOCTYPE html>
<html>
<head>
    <title>Tambah Kandidat</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Tambah Kandidat</h1>
        <form action="process_add_candidate.php" method="POST" enctype="multipart/form-data">
            <label for="name">Nama Lengkap:</label>
            <input type="text" name="name" id="name" required>

            <label for="vision">Visi:</label>
            <textarea name="vision" id="vision" required></textarea>

            <label for="mission">Misi:</label>
            <textarea name="mission" id="mission" required></textarea>

            <label for="motto">Motto Hidup:</label>
            <input type="text" name="motto" id="motto" required>

            <label for="photo">Foto:</label>
            <input type="file" name="photo" id="photo" required>

            <button type="submit">Tambah</button>
        </form>
    </div>
</body>
</html>
