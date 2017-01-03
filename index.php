<!DOCTYPE html>
<html>
<head>
    <link rel="icon" href="assets/img/logo_ipb.png">

    <title>Text Summarization</title>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Text Summarization</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="https://web.facebook.com/ahmadaminalf">About</a></li>
            </ul>
        </div>
    </div>
</nav>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Text Summarization <small class="text-muted">Teks Berbahasa Indonesia</small></h1>
            <div class="panel panel-default">
                <div class="panel-body">
                    <form method="post" action="summarization.php">
                        <div class="form-group">
                            <label for="jumlah_kalimat">Jumlah kalimat</label>
                            <select class="form-control" name="jumlah_kalimat" id="jumlah_kalimat">
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="dokumen">Dokumen</label>
                            <textarea class="form-control" rows="14" name="dokumen" id="dokumen" placeholder="Paste dokumen disini"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg">Submit >></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="text-muted pull-right">Text Summarization, <a href="cs.ipb.ac.id">cs.ipb.ac.id</a> &copy; <?= date("Y") ?></p>
    </div>
</footer>

<script src="assets/js/jquery-2.1.1.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

</body>
</html>
