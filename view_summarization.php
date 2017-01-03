<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Text Summarization</title>
    <link rel="icon" href="assets/img/logo_ipb.png">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">


</head>

<body>
<div class="container">

    <div class="page-header">
        <h1>Text Summarization <small>Teks Berbahasa Indonesia</small></h1>
        <p class="lead">Pembahasan dan hasil</p>
    </div>

    <h3>Statistik Dokumen </h3>
    <div class="row">
        <div class="col-md-4">
            <p><strong> - Jumlah Kalimat : </strong><?= count($array_kalimat)?></p>
            <p><strong> - Jumlah Kata    : </strong><?= count($array_kata)?></p>
            <p><strong> - Dirangkum menjadi    : </strong><?= $kalimat_diambil ?> kalimat</p>
        </div>
        <div class="col-md-4">
            <p><strong> - alfa : </strong><?= $alfa ?></p>
            <p><strong> - beta : </strong><?= $beta ?></p>
        </div>
    </div>

    <h3>Kalimat </h3>
    <table class="table table-condensed table-striped" >
    <?php for($i=0; $i<count($array_kalimat); $i++){ ?>
        <tr>
            <th width="10%">Kalimat <?= $i+1 ?> : </th>
            <td><?= $array_kalimat[$i]?></td>
        </tr>
    <?php } ?>
    </table>

    <h3>Tokenisasi Kata </h3>
    <table class="table table-condensed ">
        <thead>
            <tr>
                <th>#</th>
                <?php for($j=0; $j<count($array_kata); $j++){
                    echo "<th>" . $array_kata[$j] . "</th>";
                }?>
            </tr>
        </thead>
        <tbody>
        <?php for($i=0; $i<count($array_kalimat); $i++){
            echo "<tr>";
            echo "<td>Kalimat ". ($i + 1) . "</td>";
            for($j=0; $j<count($array_kata); $j++){
                echo "<td>" . $frequency[$i][$j]  . "</td>";
            }
            echo "</tr>";
        }?>
            <tr class="bg-info">
                <td class="text-warning"><b>Sigma TF</b></td>
                <?php for($j = 0; $j < count($tf); $j++){
                    echo "<td class='text-danger'><b>" . $tf[$j] . "</b></td>";
                }?>
            </tr>
            <tr class="bg-info">
                <td class="text-warning"><b>TF . IDF</b></td>
                <?php for($j = 0; $j < count($tf); $j++){
                    echo "<td class='text-danger'><b>" . number_format($tf_idf[$j], 2, '.', '') . "</b></td>";
                }?>
            </tr>

        </tbody>
    </table>

    <h3>Hasil Akhir</h3>
    <table class="table table-condensed ">
        <thead>
        <tr>
            <th>#</th>
            <?php for($j=0; $j<count($array_kata); $j++){
                echo "<th>" . $array_kata[$j] . "</th>";
            }?>
            <th class="bg-warning"><strong># Hasil</strong></th>
        </tr>
        </thead>
        <tbody>
        <?php for($i=0; $i<count($array_kalimat); $i++){
            echo "<tr>";
            echo "<td> Kalimat " . ($i +1) . "</td>";
            for($j=0; $j<count($array_kata); $j++){
                echo "<td>" . number_format($matriks_akhir[$i][$j] , 2, '.', '')  . "</td>";
            }
            echo "<td class='bg-warning'>" . number_format($hasil_akhir[$i], 2, '.', '').   "</td>";
            echo "</tr>";
        } ?>
        </tbody>
    </table>

    <h3>Rangkuman</h3>
    <div class="well well-sm">
        <p class="">
        <?php
            for($i=0; $i<count($array_kalimat); $i++){
                if(in_array($i, $index_kalimat_terambil)){
                    echo $array_kalimat[$i] . ". ";
                }
            }
        ?>
        </p>
    </div>

</div>

<footer class="footer">
    <div class="container">
        <p class="text-muted pull-right">Text Summarization, <a href="cs.ipb.ac.id">cs.ipb.ac.id</a> &copy; <?= date("Y") ?></p>
    </div>
</footer>


</body>

<script src="assets/js/jquery-2.1.1.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

</html>
