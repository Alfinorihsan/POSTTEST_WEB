<?php
include('./functions.php');

$rows = all("pesanan");

if(isset($_GET['search'])) {
    $keyword = $_GET['search'];
    $rows = query("SELECT * FROM pesanan WHERE nama LIKE '%$keyword%'");
}
?>

<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alfi Nor Ihsan - Posttest 7</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <header class="row">
        <div class="col col-4 d-flex align-items-center justify-content-center">
            <div id="mode-gelap" class="tombol" style="margin-right: 10px; padding: 10px 20px; cursor: pointer;">
                Gelap
            </div>
            <img src="./img/logo.png" id="logo">
        </div>
        <nav class="col col-8">
            <ul class="row">
            <li class="col col-4 d-flex align-items-center justify-content-center">
                    <a class="active" href="./index.php">Daftar Pesanan</a>
                </li>
                <li class="col col-4 d-flex align-items-center justify-content-center">
                    <a href="./tentang.html">Tentang</a>
                </li>
                <?php if(isset($_SESSION['login'])): ?>
                    <li class="col col-4 d-flex align-items-center justify-content-center">
                        <a href="./logout.php" class="tombol">Logout</a>
                    </li>
                <?php else: ?>
                    <li class="col col-2 d-flex align-items-center justify-content-center">
                        <a href="./login.php" class="tombol">Login</a>
                    </li>
                    <li class="col col-2 d-flex align-items-center justify-content-center">
                        <a href="./register.php" class="tombol">Register</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <main>
        <div id="bagian-atas" style="min-height: 80vh;">
            <div class="row">
                <div class="col col-8">
                    <h1 style="margin-top: 0px;">Hi, <?= $_SESSION['nama'] ?></h1>
                </div>
                <div class="col col-4" style="display: flex; align-items: center; justify-content: flex-end;">
                    <a href="./tambah.php">Tambah Data</a>
                </div>
                <div class="col-12">
                <form action="" method="">
                        <div class="form-control">
                            <label for="" style="text-align: center;display: flex;align-items: center;background: var(--primary);color: #fff;padding-left: 10px;">Pencarian</label>
                            <input type="text" name="search" placeholder="cari berdasarkan nama..." required value="<?= $_GET['search'] ?? '' ?>">
                            <button type="submit" class="tombol">Pesan</button>
                        </div>
                    </form>
                </div>
                <div class="col col-12">
                    <table>
                        <thead>
                            <tr>
                                <th style="text-align: center;">#</th>
                                <th>Nama</th>
                                <th>Kontak</th>
                                <th>Jenis Pakaian</th>
                                <th>Total</th>
                                <th>Tgl. Pengambilan</th>
                                <th>Bukti Pembayaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($rows as $row) : ?>
                                <tr>
                                    <th scope="row" style="text-align: center;"><?= $i ?></th>
                                    <td><?= $row['nama'] ?></td>
                                    <td><?= $row['kontak'] ?></td>
                                    <td><?= $row['jenis_pakaian'] ?> </td>
                                    <td><?= $row['total'] ?> </td>
                                    <td><?= $row['tgl_pengambilan'] ?> </td>
                                    <td>
                                        <img src="./bukti-pembayaran/<?= $row['bukti_pembayaran'] ?> " alt="" style="height: 300px; background-size: cover; object-fit: cover;">
                                    </td>
                                    <td class="text-center">
                                        <a href="./ubah.php?id=<?= $row['id'] ?>" class="edit-btn">
                                            Ubah
                                        </a>
                                        <a href="./hapus.php?id=<?= $row['id'] ?>" class="delete-btn">
                                            Hapus
                                        </a>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <div class="row">
            <div class="col d-flex align-items-center justify-content-center">
                <img src="./img/logo_dua.png" alt="" class="gambar">
            </div>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            const darkmodeToggle = document.getElementById('mode-gelap')
            darkmodeToggle.addEventListener('click', function() {
                const theme = $('html').attr('data-theme');
                if (theme == 'light') {
                    // * CHANGE TO DARK
                    $('html').css({
                        'filter': 'invert(1)'
                    })
                    $('img').css({
                        'filter': 'invert(100%)'
                    })

                    // DOM
                    $('footer').css({
                        'background': '#fff',
                        'color': '#000'
                    })
                    $('.tombol').css({
                        'border-radius': '30px'
                    })
                    $('.tombol-kedua').css({
                        'border-radius': '30px'
                    })

                    $('html').attr('data-theme', 'dark');
                } else {
                    // * CHANGE TO LIGHT
                    $('html').removeAttr('style');
                    $('img').removeAttr('style');

                    // DOM
                    $('footer').removeAttr('style');
                    $('.tombol').css({
                        'border-radius': '0px'
                    })
                    $('.tombol-kedua').css({
                        'border-radius': '0px'
                    })

                    darkmodeToggle.innerHTML = 'Gelap'
                    $('html').attr('data-theme', 'light')
                }
            });

            $('#pesan-sekarang').click(function() {
                alert('Terima kasih!')
            })
        });
    </script>
</body>

</html>