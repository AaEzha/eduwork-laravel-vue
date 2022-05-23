<html>

<head>
    <title>LOGIC TEST </title>
</head>

<body>
    <h2>FUNGSI 4 & 8</h2>
    <?php

    echo "\tProgram Perhitungan Bilangan Faktorial PHP\n\n";

    $a = 1;
    $faktorial = $a;
    $angka = 8;

    while ($a <= $angka) {
        $faktorial = $faktorial * $a;
        $a++;
    }

    echo "\tAngka Faktorial : ";
    echo $angka;
    echo "\n";

    echo "\tHasil Perhitungan Faktorial adalah : ";
    echo $faktorial;
    ?>


    <h2>REVERSE STRING</h2>
    <?php
    $string = "abcde";
    $length = strlen($string);
    echo 'REVERSE STRING DARI abcde ADALAH';
    for ($i = ($length - 1); $i >= 0; $i--) {
        echo $string[$i];
    }
    ?>

    <h2>SWAP CODE</h2>
    <?php
    $a = 3;
    $b = 7;
    $temp = $a;
    $a = $b;
    $b = $temp;
    echo "after swapping";
    echo "a =" . $a . " b=" . $b; ?>

    <h1>Membuat Fungsi Terbilang</h1>
    <?php
    function penyebut($nilai)
    {
        $nilai = abs($nilai);
        $huruf = array("nol", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        $temp = "";
        if ($nilai < 12) {
            $temp = " " . $huruf[$nilai];
        } else if ($nilai < 20) {
            $temp = penyebut($nilai - 10) . " belas";
        } else if ($nilai < 100) {
            $temp = penyebut($nilai / 10) . " puluh" . penyebut($nilai % 10);
        } else if ($nilai <= 103) {
            $temp = " seratus" . penyebut($nilai - 100);
        } elseif ($nilai > 103)
            $temp = "silahkan masukkan bilangan 1-100";
        return $temp;
    }
    function terbilang($nilai)
    {
        if ($nilai < 0) {
            $hasil = "minus " . trim(penyebut($nilai));
        } else {
            $hasil = trim(penyebut($nilai));
        }
        return $hasil;
    }
    $angka = 103;
    echo terbilang($angka);
    ?>

    <h2>MIN MAX</h2>
    <?php
    error_reporting(0);
    $nilai = array(4, 2, 6, 88, 3, 11);
    $jml = count($nilai);
    for ($i = 0; $i <= $jml - 1; $i++) {
        $j = $i + 1;
        if ($nilai[$i] >= $nilai[$j]) {
            $j = $nilai[$j];
        } else {
            $temp = $nilai[$j];
            if ($nilai[$j] >= $temp) {
                $maksimal = $nilai[$j];
            } else {
                $maksimal = $temp;
            }
        }
    }
    echo 'HIGH [4, 2, 6, 88, 3, 11] adalah <b style=font-size:34px;>' . $maksimal . '</b>';
    ?>

    <h2>CEK TAHUN KABISAT </h2>
    <form method="post" action="">
        Masukkan tahun <input type="text" name="bil" /><br />
        <input type="submit" name="submit" value="Submit" />
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $TAHUN = $_POST['bil'];
        if ($TAHUN % 4 == 0) {
            echo "$TAHUN TAHUN KABISAT";
        } else if ($TAHUN % 4 != 0) {
            echo "$TAHUN BUKAN TAHUN KABISAT";
        }
    }
    ?>
</body>

</html>