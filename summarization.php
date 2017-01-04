<?php
/**
 * Created by PhpStorm.
 * User: ISYFALANA
 * Date: 03/01/2017
 * Time: 16:44
 */


class Summarization{

    /**
     * Isi dokumennya
     */
    private $document = "";

    private $alfa = 0.6;

    private $beta = 0.4;

    private $array_kalimat = array();

    private $banyak_kalimat;

    private $array_kata = array();

    private $banyak_kata;

    // Frekuensi kata dalam dokumen
    private $frequency = array();

    // Jumlah frekuensi kata dari setiap kalimat (per kata)
    private $tf = array();

    // TF IDF
    private $tf_idf = array();

    private $matriks_akhir = array();

    private $urutan_hasil  = array();

    private $hasil_akhir = array();

    private $index_kalimat_terambil = array();


    public function initDocument(){
        $this->document = $_POST['dokumen'];
    }

    public function tokenisasiKeKalimat(){
        // $this->array_kalimat  = preg_split('/[.?!]/', $this->document, -1, PREG_SPLIT_NO_EMPTY);
        // Terima kasih untuk https://github.com/vanderlee/php-sentence
        include("Sentence.php");
        $Sentence   = new Sentence();
        $this->array_kalimat  = $Sentence->split($this->document);
        $this->banyak_kalimat = count($this->array_kalimat);

        for($i=0; $i < count($this->array_kalimat); $i++){
            $this->array_kalimat[$i] = preg_replace("/[\?.!]$/","", trim($this->array_kalimat[$i]));
        }

    }

    public function tokenisasiKeKata(){
        for($i=0; $i<count($this->array_kalimat); $i++){
            $temp_kata = preg_split( "/[\s,]+/", $this->array_kalimat[$i], -1, PREG_SPLIT_NO_EMPTY );
            for($j = 0; $j < count($temp_kata); $j++){
                if(! in_array(strtolower($temp_kata[$j]), $this->array_kata )){					
                    $this->array_kata[] = strtolower(preg_replace('/(^[\"\'\(]|[\"\'\)\:\.,]$)/',"", trim($temp_kata[$j]))); 
                }
            }
        }
        $this->banyak_kata = count($this->array_kata);
    }

    public function buangStopWords(){
        $stop_words = array();
        include('stop_words.php');
        $this->array_kata = array_values( array_diff($this->array_kata, $stop_words) );
        $this->banyak_kata = count($this->array_kata);
    }

    function jumlah_kata_tertentu_dalam_kalimat($kata, $kalimat){
        $jumlah = 0;
        $temp_kata = preg_split("/[\s,]+/", $kalimat);
        for($i=0;$i<count($temp_kata); $i++){
            if(strcasecmp($kata, strtolower(preg_replace('/(^[\"\'\(]|[\"\'\)\:\.,]$)/',"", trim($temp_kata[$i])))) == 0){
                $jumlah++;
            }
        }
        return $jumlah;
    }


    public function hitungTermFrequency(){
        for($i=0; $i<count($this->array_kalimat); $i++){
            for($j=0; $j<count($this->array_kata); $j++){
                $this->frequency[$i][$j] = $this->jumlah_kata_tertentu_dalam_kalimat($this->array_kata[$j], $this->array_kalimat[$i]);
            }
        }
    }


    public function hitungtermFrequencyPerkolom(){
        for($i = 0; $i < count($this->array_kata); $i++){
            $this->tf[$i] = 0;
            for($j = 0; $j < count($this->array_kalimat); $j++){
                $this->tf[$i] += $this->frequency[$j][$i];
            }
        }
    }

    public function hitungTfIdf(){
        for($i = 0; $i < count($this->array_kata); $i++){
            $this->tf_idf[$i] = log(count($this->array_kata) / $this->tf[$i], 2);
        }
    }

    public function hitungMatrixKaliDenganTfIdf(){
        for($i=0; $i<count($this->array_kalimat); $i++){
            $this->urutan_hasil[$i] = 0;
            for($j=0; $j<count($this->array_kata); $j++){
                $this->matriks_akhir[$i][$j]  = $this->tf_idf[$j] * $this->frequency[$i][$j];
                $this->urutan_hasil[$i]      += $this->matriks_akhir[$i][$j];
            }
        }
    }

    public function hitungUrutanKalimatYangDitampilkan(){
        for($i=0; $i<count($this->array_kalimat); $i++){
            $this->hasil_akhir[$i] = ($this->alfa * $this->urutan_hasil[$i]) + ($this->beta * ((count($this->array_kalimat) - $i)  / count($this->array_kalimat)));
        }
    }

    public function getKalimatTerambil(){
        $kalimat_diambil        = $_POST['jumlah_kalimat'];
        $hasil_akhir_copy       = $this->hasil_akhir;
        $i = 0;
        while($i < $kalimat_diambil){
            $maxs = array_keys($hasil_akhir_copy, max($hasil_akhir_copy));
            $this->index_kalimat_terambil[] = $maxs[0];
            unset($hasil_akhir_copy[$maxs[0]]);
            $i++;
        }

    }





    public function summary(){
        $this->initDocument();
        $this->tokenisasiKeKalimat();
        $this->tokenisasiKeKata();
        $this->buangStopWords();
        $this->hitungTermFrequency();
        $this->hitungtermFrequencyPerkolom();
        $this->hitungTfIdf();
        $this->hitungMatrixKaliDenganTfIdf();
        $this->hitungUrutanKalimatYangDitampilkan();
        $this->getKalimatTerambil();

        $alfa           = $this->alfa;
        $beta           = $this->beta;
        $array_kalimat  = $this->array_kalimat;
        $banyak_kalimat = $this->banyak_kalimat;
        $array_kata     = $this->array_kata;
        $banyak_kata    = $this->banyak_kata;
        $frequency      = $this->frequency;
        $tf             = $this->tf;
        $tf_idf         = $this->tf_idf;
        $matriks_akhir  = $this->matriks_akhir;
        $urutan_hasil   = $this->urutan_hasil ;
        $hasil_akhir    = $this->hasil_akhir;
        $index_kalimat_terambil = $this->index_kalimat_terambil;
        $kalimat_diambil        = $_POST['jumlah_kalimat'];

        include('view_summarization.php');
    }
}

$app = new Summarization();
$app->summary();