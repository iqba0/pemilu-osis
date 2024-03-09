<?php
include 'config.php';

// Mendapatkan ID voter dari parameter URL
if (isset($_GET['id'])) {
    $voterId = $_GET['id'];
} else {
    echo "ID voter tidak ditemukan.";
    exit();
}

// Mendapatkan data voter berdasarkan ID
function getVoterById($id)
{
    global $conn;
    $id = mysqli_real_escape_string($conn, $id);
    $query = mysqli_query($conn, "SELECT * FROM users WHERE id = '$id'");
    $voter = mysqli_fetch_assoc($query);
    return $voter;
}

// Mendapatkan data voter berdasarkan ID
$voter = getVoterById($voterId);

// Memastikan data voter tersedia
if (!$voter) {
    echo "ID voter tidak ditemukan.";
    exit();
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Voter</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Edit Voter</h1>

        <form action="proses_edit_voters.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $voter['id']; ?>">

            <label for="full_name">Nama Lengkap:</label>
            <input type="text" name="full_name" id="full_name" value="<?php echo $voter['full_name']; ?>" required>

            <label for="username">Username:</label>
            <input type="text" name="username" id="username" value="<?php echo $voter['username']; ?>" required>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" value="<?php echo $voter['password']; ?>" required>

            <button type="submit">Simpan</button>
        </form>
    </div>
</body>
</html>
