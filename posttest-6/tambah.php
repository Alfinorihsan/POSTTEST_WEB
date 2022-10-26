<?php
  include('./functions.php');

  if(isset($_POST['nama'])) {
    $namaFile = $_FILES['bukti_pembayaran']['name'];
	$ukuranFile = $_FILES['bukti_pembayaran']['size'];
	$error = $_FILES['bukti_pembayaran']['error'];
	$tmpName = $_FILES['bukti_pembayaran']['tmp_name'];

	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));

	$file = uniqid();
	$file .= '.';
	$file .= $ekstensiGambar;

	move_uploaded_file($tmpName, "./bukti-pembayaran/$file");
    store("pesanan", [
        "nama" => $_POST["nama"],
        "kontak" => $_POST["kontak"],
        "jenis_pakaian" => $_POST["jenis_pakaian"],
        "total" => $_POST["total"],
        "tgl_pengambilan" => $_POST["tgl_pengambilan"],
        "bukti_pembayaran" => $file,
    ]);
    header("location:index.php");
  }
?>

<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alfi Nor Ihsan - Posttest 5</title>

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
                <li class="col col-4 d-flex align-items-center justify-content-center">
                    <a id="pesan-sekarang" class="tombol">Pesan Sekarang</a>
                </li>
            </ul>
        </nav>
    </header>

    <main>
        <div id="bagian-atas" style="min-height: 80vh;">
            <div class="row">
                <div class="col col-12">
                    <h1 style="margin-left: 10%;">Buat Pesanan</h1>
                    <form action="" method="POST" style="margin-left: 10%;" enctype="multipart/form-data">
                        <div class="form-control">
                            <label for="">Nama</label>
                            <input type="text" name="nama" required>
                        </div>
                        <div class="form-control">
                            <label for="">Kontak</label>
                            <input type="tel" name="kontak" required>
                        </div>
                        <div class="form-control">
                            <label for="">Jenis Pakaian</label>
                            <select name="jenis_pakaian" required>
                                <option value="Baju Polos" selected>Baju Polos</option>
                                <option value="Celana Polos">Celana Polos</option>
                            </select>
                        </div>
                        <div class="form-control">
                            <label for="">Total</label>
                            <input type="number" name="total" required>
                        </div>
                        <div class="form-control">
                            <label for="">Tanggal Pengambilan</label>
                            <input type="date" name="tgl_pengambilan" required>
                        </div>
                        <div class="form-control">
                            <label for="">Bukti Pembayaran</label>
                            <input type="file" name="bukti_pembayaran" required>
                        </div>
                        <div class="form-control" style="align-items: center; justify-content: flex-end; margin-top: 20px;">
                            <button type="submit" class="tombol">Pesan</button>
                        </div>
                    </form>
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