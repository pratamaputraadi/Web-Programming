<?php
function hitungPajak($asal, $tujuan) {
    $pajak_asal = [
        "Soekarno Hatta" => 65000,
        "Husein Sastranegara" => 50000,
        "Abdul Rachman Saleh" => 40000,
        "Juanda" => 30000
    ];

    $pajak_tujuan = [
        "Ngurah Rai" => 85000,
        "Hasanuddin" => 70000,
        "Inanwatan" => 90000,
        "Sultan Iskandar Muda" => 60000
    ];

    if (!isset($pajak_asal[$asal]) || !isset($pajak_tujuan[$tujuan])) {
        return 0;
    }

    return $pajak_asal[$asal] + $pajak_tujuan[$tujuan];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pendaftaran Rute Penerbangan</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-image: url('gambar.png');
            background-size: cover;
            background-position: center;
            margin: 0;
            padding: 0;
            color: #3a2e2e;
        }

        .container {
            max-width: 650px;
            margin: 60px auto;
            background-color: rgba(255, 250, 245, 0.95);
            padding: 35px 45px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #d97706;
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin-top: 18px;
            font-weight: 600;
            color: #5b4033;
        }

        input[type="text"], input[type="number"], select {
            width: 100%;
            padding: 12px;
            margin-top: 5px;
            border: 1px solid #e2b693;
            border-radius: 10px;
            font-size: 15px;
            background-color: #fffaf4;
            box-sizing: border-box;
        }

        button {
            margin-top: 30px;
            width: 100%;
            background: linear-gradient(to right, #f59e0b, #fbbf24);
            color: #3a2e2e;
            padding: 14px;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background: linear-gradient(to right, #fbbf24, #fcd34d);
        }

        .result {
            margin-top: 30px;
            background: #fff7ed;
            padding: 20px;
            border-radius: 12px;
            border-left: 6px solid #f59e0b;
        }

        .result h3 {
            color: #b45309;
            margin-bottom: 15px;
        }

        .result p {
            margin: 8px 0;
        }

        .btn-kembali {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #dc2626;
            color: white;
            text-decoration: none;
            border-radius: 10px;
            font-weight: bold;
            transition: background 0.3s ease;
        }

        .btn-kembali:hover {
            background-color: #b91c1c;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Pendaftaran Rute Penerbangan</h2>

    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
        <?php
            $maskapai = $_POST['maskapai'];
            $asal = $_POST['bandara_asal'];
            $tujuan = $_POST['bandara_tujuan'];
            $harga = (int) $_POST['harga_tiket'];
            $tanggal = date("Y-m-d");
            $nomor = rand(1000, 9999);

            $pajak = hitungPajak($asal, $tujuan);
            $total = $harga + $pajak;
        ?>
        <div class="result">
            <h3>Data Penerbangan</h3>
            <p><strong>Nomor:</strong> <?= $nomor ?></p>
            <p><strong>Tanggal:</strong> <?= $tanggal ?></p>
            <p><strong>Nama Maskapai:</strong> <?= htmlspecialchars($maskapai) ?></p>
            <p><strong>Asal Penerbangan:</strong> <?= $asal ?></p>
            <p><strong>Tujuan Penerbangan:</strong> <?= $tujuan ?></p>
            <p><strong>Harga Tiket:</strong> Rp <?= number_format($harga, 0, ',', '.') ?></p>
            <p><strong>Pajak:</strong> Rp <?= number_format($pajak, 0, ',', '.') ?></p>
            <p><strong>Total Harga Tiket:</strong> Rp <?= number_format($total, 0, ',', '.') ?></p>
        </div>
        <a href="<?= $_SERVER['PHP_SELF'] ?>" class="btn-kembali">Kembali ke Form</a>
    <?php else: ?>
        <?php
            $asal_list = ["Soekarno Hatta", "Husein Sastranegara", "Abdul Rachman Saleh", "Juanda"];
            $tujuan_list = ["Ngurah Rai", "Hasanuddin", "Inanwatan", "Sultan Iskandar Muda"];
            sort($asal_list);
            sort($tujuan_list);
        ?>
        <form method="post" action="">
            <label for="maskapai">Nama Maskapai</label>
            <input type="text" name="maskapai" id="maskapai" required>

            <label for="asal">Bandara Asal</label>
            <select name="bandara_asal" id="asal" required>
                <?php foreach ($asal_list as $b): ?>
                    <option value="<?= $b ?>"><?= $b ?></option>
                <?php endforeach; ?>
            </select>

            <label for="tujuan">Bandara Tujuan</label>
            <select name="bandara_tujuan" id="tujuan" required>
                <?php foreach ($tujuan_list as $b): ?>
                    <option value="<?= $b ?>"><?= $b ?></option>
                <?php endforeach; ?>
            </select>

            <label for="harga">Harga Tiket</label>
            <input type="number" name="harga_tiket" id="harga" required>

            <button type="submit">Daftar Penerbangan</button>
        </form>
    <?php endif; ?>
</div>
</body>
</html>