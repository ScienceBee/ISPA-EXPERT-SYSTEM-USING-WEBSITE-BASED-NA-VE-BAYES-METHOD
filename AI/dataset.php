<?php
include 'koneksi.php';
$query = mysqli_query($koneksi, "SELECT * FROM penyakit");
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
                            <li><a class="dropdown-item" href="prediksi.php">Diagnosis</a></li>
                        </ul>
                    </li>
                </ul>

            </div>
        </div>

    </nav>

    <div class="h-50 mx-auto" style="width: 80%;">
        <table class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th class="th-sm">No
                    </th>
                    <th class="th-sm">Kode Penyakit
                    </th>
                    <th class="th-sm">Nama Penyakit
                    </th>
                    </th>
                    <th class="th-sm">Rule
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $a = 0;
                    while ($db_row = mysqli_fetch_array($query)) {
                        //var_dump($db_row);
                    ?>
                <tr>
                    <td>
                        <?php echo $a + 1; ?>
                    </td>
                    <td>
                        <?php echo $db_row["id_penyakit"]; ?>
                    </td>
                    <td>
                        <?php echo $db_row["nama_penyakit"]; ?>
                    </td>
                    <td>
                        <?php echo $db_row["id_gejala"]; ?>
                    </td>
                </tr>
                <?php
                        $a++;
                    }
                    ?>
            </tbody>
        </table>

    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</body>

</html>