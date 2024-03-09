<!DOCTYPE html>
<html>
<head>
    <title>Tambah Kandidat</title>
    <link rel="shortcut icon" href="logo.png">
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}
nav {
    background-color: #333;
    color: #fff;
    padding: 10px;
}

nav ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
}

nav ul li {
    display: inline-block;
    margin-right: 10px;
}

nav ul li a {
    color: #fff;
    text-decoration: none;
}
h1 {
    margin-top: 0;
}

form {
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 5px;
}

input[type="text"],
textarea {
    padding: 8px;
    margin-bottom: 10px;
    width: 100%;
}

button {
    padding: 8px 15px;
    background-color: #333;
    color: #fff;
    border: none;
    cursor: pointer;
}

    </style>
</head>
<body>
     <nav>
        <ul>
            <li><a href="admin.php">Home</a></li>
        </ul>
    </nav>
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
