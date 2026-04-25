<?php 
session_start();
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logging Out...</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --dusty-pink: #DBA39A;
            --cream: #FEFCF3;
        }
        body {
            background-color: var(--cream);
            font-family: 'Poppins', sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            overflow: hidden;
        }
        .logout-container {
            text-align: center;
            animation: fadeIn 0.8s ease-out;
        }
        .spinner-pink {
            width: 3rem;
            height: 3rem;
            border: 5px solid var(--dusty-pink);
            border-bottom-color: transparent;
            border-radius: 50%;
            display: inline-block;
            animation: rotation 1s linear infinite;
            margin-bottom: 20px;
        }
        .flower-icon {
            font-size: 3rem;
            display: block;
            margin-bottom: 15px;
            animation: heartbeat 1.5s infinite;
        }
        @keyframes rotation {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        @keyframes heartbeat {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

    <div class="logout-container">
        <span class="flower-icon">🌸</span>
        <div class="spinner-pink"></div>
        <h4 class="fw-bold" style="color: #6D5D6E;">Sampai Jumpa Lagi!</h4>
        <p class="text-muted small">Sedang mengamankan sesi Anda...</p>
    </div>

    <script>
        // Tunggu 2 detik agar animasi terlihat, lalu pindah ke beranda
        setTimeout(function() {
            window.location.href = "index.php?pesan=logout";
        }, 2000);
    </script>
</body>
</html>