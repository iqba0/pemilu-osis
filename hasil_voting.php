<!DOCTYPE html>
<html>
<head>
    <title>Real-Time Voting Results</title>
    <link rel="shortcut icon" href="logo.png">
    <style>
        .candidate {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .candidate-image {
            width: 50px;
            height: 50px;
            margin-right: 10px;
        }

        .candidate-name {
            font-weight: bold;
        }

        .vote-count {
            font-size: 18px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Fungsi untuk memperbarui hasil voting secara real-time
            function updateResults() {
                $.ajax({
                    url: 'get_voting_results.php',
                    type: 'GET',
                    success: function(response) {
                        // Memperbarui tampilan hasil voting
                        $('#voting-results').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.log('Gagal memperbarui hasil voting.');
                    }
                });
            }

            // Memperbarui hasil voting setiap 5 detik
            setInterval(updateResults, 5000);
        });
    </script>
</head>
<body>
    <h1>Real-Time Voting Results</h1>

    <div id="voting-results">
        <!-- Hasil voting akan ditampilkan di sini -->
    </div>

    <script>
        $(document).ready(function() {
            // Fungsi untuk mendapatkan hasil voting dari server
            function getVotingResults() {
                $.ajax({
                    url: 'get_voting_results.php',
                    type: 'GET',
                    success: function(response) {
                        // Memperbarui tampilan hasil voting
                        $('#voting-results').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.log('Gagal mendapatkan hasil voting.');
                    }
                });
            }

            // Memanggil fungsi getVotingResults() saat halaman dimuat
            getVotingResults();
        });
    </script>
</body>
</html>
