<!DOCTYPE html>
<html>
<head>
    <title>Edit Kandidat</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Edit Kandidat</h1>
        <?php
        include 'config.php';

        $candidateId = $_GET['id'];
        // Ambil data kandidat berdasarkan ID dari database
        $query = mysqli_query($conn, "SELECT * FROM candidates WHERE id = $candidateId");
        $candidate = mysqli_fetch_assoc($query);
        ?>

        <form action="process_edit_candidate.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $candidate['id']; ?>">

            <label for="name">Nama Lengkap:</label>
            <input type="text" name="name" id="name" value="<?php echo $candidate['name']; ?>" required>

            <label for="vision">Visi:</label>
            <textarea name="vision" id="vision" required><?php echo $candidate['vision']; ?></textarea>

            <label for="mission">Misi:</label>
            <textarea name="mission" id="mission" required><?php echo $candidate['mission']; ?></textarea>

            <label for="motto">Motto Hidup:</label>
            <input type="text" name="motto" id="motto" value="<?php echo $candidate['motto']; ?>" required>

            <label for="photo">Foto:</label>
            <input type="file" name="photo" id="photo">

            <button type="submit">Simpan</button>
        </form>
    </div>
</body>
</html>
