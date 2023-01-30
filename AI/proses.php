<?php
include 'koneksi.php';
$query = mysqli_query($koneksi, "SELECT * FROM gejala");
?>


<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Naive Bayes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <style>
        .atas {
            width: 100%;
            height: 55px;

        }

        body {
            background-color: rgb(233, 233, 233);
            box-sizing: border-box;
        }

        .tulisan {
            color: grey;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #35858B;">
        <div class="container">
            <a class="navbar-brand" href="index.php"><i class="fa-solid fa-lungs-virus"></i> ISPA DIAGNOSIS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php"><i class="fa-solid fa-house"
                                style="margin-right:5px ;"></i>Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Menu Naive Bayes
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="dataset.php">Dataset</a></li>
                            <li><a class="dropdown-item" href="gejala.php">Data Gejala</a></li>
                            <li><a class="dropdown-item" href="penyakit.php">Data Penyakit</a></li>
                            <li><a class="dropdown-item" href="prediksi.php">Prediksi</a></li>
                        </ul>
                    </li>
                </ul>

            </div>
        </div>

    </nav <div class="container">

    <div class="row">
        <div class="col-lg-3 bg-white p-3">
            <a href="prediksi.php" class="text-center w-100"><button style="background-color: #35858B; color: white; width: 360px; border-radius: 20px;">HASIL
                    ANALISIS</button></a>
            <div class="d-flex flex-column gap-1" style="margin-top: 25px;">
                <?php
                    $query_penyakit = mysqli_query($koneksi, "SELECT COUNT(id_penyakit) AS jumlah_penyakit FROM penyakit");
                    $query_gejala = mysqli_query($koneksi, "SELECT COUNT(id_gejala) AS jumlah_gejala FROM gejala");
                    $result_penyakit = mysqli_fetch_assoc($query_penyakit);
                    $result_gejala = mysqli_fetch_assoc($query_gejala);
                    $JmlPenyakit = $result_penyakit['jumlah_penyakit'];
                    $JmlGejala = $result_gejala['jumlah_gejala'];
                    $PeluangPenyakit = 1 / $JmlPenyakit;

                    $Gejala = array();
                    $i = 0;
                    for ($a = 0; $a < $JmlGejala; $a++) {
                        if ((isset($_POST['gejala'][$a]) > 0) && ($_POST['gejala'][$a])) {
                            $Gejala[$i] = $_POST['gejala'][$a];
                            $i++;
                        }
                    }
                    echo '<table class="table table-striped table-bordered">';
                    echo '<tr><td>Jumlah Penyakit : ' . $JmlPenyakit . '</td>';
                    echo '<td>Jumlah Gejala : ' . $JmlGejala . '</td></tr>';
                    echo '<tr><td>Peluang Penyakit : ' . $PeluangPenyakit . '</td>';
                    echo '<td>Jumlah Gejala yang dialami : ' . $i . '</td></tr></table>';
                    ?>
            </div>
        </div>

        <div class="col-lg-9 bg-white d-flex" style="min-height: 500px;">
            <div style="background-color: rgb(233, 233, 233); width: 10px;"></div>
            <div class="p-3 w-100 h-100">
                <?php
                    $x = 0;
                    $query_data = mysqli_query($koneksi, "SELECT id_penyakit, nama_penyakit,id_gejala FROM penyakit ORDER BY id_penyakit");
                    $result_query = mysqli_num_rows($query_data);

                    echo '<div class="row">';
                    $PeluangPenyakit = 1 / $JmlPenyakit;

                    //hitung pada tiap gejala
                    $Total = array();
                    for ($a = 0; $a < $result_query; $a++) {
                        $DataPenyakit = mysqli_fetch_assoc($query_data);



                        echo '<div class="col-sm-4 border">
                            <div class="thumbnail">';
                        echo '<p style="margin-top:0px;"><b>' . ($a + 1) . ' | ' . $DataPenyakit['nama_penyakit'] . '</b></p>';


                        $P = 1;
                        foreach ($Gejala as $g) {
                            $cek = stripos($DataPenyakit['id_gejala'], $g);
                            $nc = 1;

                            if ($cek === false) {
                                $nc = 0;
                            }


                            echo '<p>Nc (' . $g . ') : ' . $nc . '<br/>';

                            $Prob = ($nc + $JmlGejala * $PeluangPenyakit) / (1 + $JmlGejala);

                            echo 'P (' . $g . ') : ' . $Prob;

                            $P = $P * $Prob;
                        }

                        $Total[$a]['Probabilitas'] = $P * $PeluangPenyakit;
                        $Total[$a]['id_penyakit'] = $DataPenyakit['id_penyakit'];
                        $Total[$a]['nama_penyakit'] = $DataPenyakit['nama_penyakit'];

                        echo '<p><b>P (' . $Total[$a]['id_penyakit'] . ') : </b>' . $Total[$a]['Probabilitas'] . '</p>';
                        echo '<hr>';
                        echo '</div></div>';
                    }

                    //sort hasil
                    $prob = array();
                    $idpenyakit = array();
                    $penyakit = array();

                    foreach ($Total as $key => $row) {
                        $idpenyakit[$key] = $row['id_penyakit'];
                        $penyakit[$key] = $row['nama_penyakit'];
                        $prob[$key] = $row['Probabilitas'];
                    }
                    array_multisort($prob, SORT_DESC, $Total);

                    $n = 1;
                    $NBPenyakit = array($Total[0]['id_penyakit'], $Total[0]['nama_penyakit']);
                    ?>

                <div class="bg-white mt-2" style="height:150px; width:300px; border-radius:10px;">
                    <h3 style="text-align: center; border-radius:10px; background-color: #35858B; color: white;">HASIL DIAGNOSIS:
                    </h3>
                    <h1
                        style="padding: 10px;border-radius:10px; margin-top:-5px; text-align: center; background-color: #B3E8E5;">
                        <?php echo $NBPenyakit[1] ?>
                    </h1>
                </div>
            </div>
        </div>
    </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</body>

</html>