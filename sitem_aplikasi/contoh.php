<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Sistem Keamanan Data</title>
</head>

<body>
    <div class="container">
        <div class="card card-outline card-primary">
            <div class="card-header text-center bg-info">
                <h4><b>PSKD</b></h4>
            </div>
            <div class="card-body bg-warning">
                <?php
                if (isset($_POST['enkripsi'])) { //mengeksekusi enkripsi 
                    function cipher($char, $key)
                    { //menampung data yang telah di input
                        if (ctype_alpha($char)) { //cek alphabet atau tidak
                            $nilai = ord(ctype_upper($char) ? 'A' : 'a');
                            $ch = ord($char); //konversi char yang diinput ke ASCII
                            $mod = fmod($ch + $key - $nilai, 26); //perhitangan modulus dengan  jumlah alphabet=26
                            $hasil = chr($mod + $nilai); //hasil modulus ditambah dengan nilai dan konversi ke bentuk alphabet, dan tampung dalam variabel
                            return $hasil; //mengembalikan nilai hasil
                        } else { //jika yang diinput bukan alphabet maka kembalikan nilai char
                            return $char;
                        }
                    }
                    //fungsi enkripsi
                    function enkripsi($input, $key)
                    {
                        $output = ""; //variabel yang menampung string
                        $chars = str_split($input); //variabel untuk menampung data
                        //berisi dengan data input yang dikonversi ke dalam bentuk array
                        foreach ($chars as $char) { //perulangan untuk menampilkan data array
                            $output .= cipher($char, $key); //berisi hasil function cipher
                        }
                        return $output; //mengembalikan nilai
                    }
                    //buat fungsi dekripsi
                    function dekripsi($input, $key)
                    {
                        return enkripsi($input, 26 - $key); //mengembalikan nilai fungsi enkripsi
                    }

                    //mengeksekusi enkripsi 
                } else if (isset($_POST['dekripsi'])) {
                    function cipher($char, $key)
                    { //buat fungsi cipher 
                        if (ctype_alpha($char)) { //cek alphabet atau tidak
                            $nilai = ord(ctype_upper($char) ? 'A' : 'a');
                            $ch = ord($char); //konversi char yang diinput ke ASCII
                            $mod = fmod($ch + $key - $nilai, 26); //perhitangan modulus dengan  jumlah alphabet=26
                            $hasil = chr($mod + $nilai); //hasil modulus ditambah dengan nilai dan konversi ke bentuk alphabet, dan tampung dalam variabel
                            return $hasil; //mengembalikan nilai yang telah di inputkan
                        } else { //jika yang diinput bukan alphabet maka kembalikan nilai char
                            return $char;
                        }
                    }

                    //buat fungsi enkripsi
                    function enkripsi($input, $key)
                    {
                        $output = ""; //variabel yang menampung string
                        $chars = str_split($input); //variabel untuk menampung data array
                        //berisi dengan data input yang dikonversi ke dalam bentuk array
                        foreach ($chars as $char) { //perulangan untuk menampilkan data array
                            $output .= cipher($char, $key); //berisi hasil function cipher
                        }
                        return $output; //mengembalikan nilai output
                    }

                    //buat fungsi dekripsi
                    function dekripsi($input, $key)
                    {
                        return enkripsi($input, 26 - $key); //mengembalikan nilai fungsi enkripsi, namun jumlah alphabet dikurangi key
                    }
                }
                ?>

                <!-- Form  -->
                <form name="skd" method="post">
                    <!-- Form input text -->
                    <div class="input-group mb-3">
                        <input type="text" name="plain" class="form-control" placeholder="Input Text">
                    </div>
                    <!-- Form input key -->
                    <div class="input-group mb-3">
                        <input type="number" name="key" class="form-control" placeholder="Input Key">
                    </div>
                    <div class="box-footer">
                        <table class="table table-stripped">
                            <tr>
                                <!-- button enkripsi dan dekripsi -->
                                <td><input class="btn btn-success" type="submit" name="enkripsi" value="Enkripsi" style="width: 100%"></td>
                                <td><input class="btn btn-danger" type="submit" name="dekripsi" value="Dekripsi" style="width: 100%"></td>
                            </tr>
                        </table>
                    </div>
                </form>
            </div>
            <!-- Hasil enkripsi/dekripsi -->
            <div class="card-header text-center bg-info">
                <h4><b>HASIL</b></h4>
            </div>
            <div class="card-body">
                <table>
                    <!-- Menampilkan hasil output dari enkripsi/dekripsi -->
                    <tr>
                        <td> Output yang dihasilkan : </td>
                        <td><b>
                                <?php if (isset($_POST['enkripsi'])) { 
                                    echo enkripsi($_POST['plain'], $_POST['key']); //memanggil fungsi enkripsi dan menampilkannya
                                }
                                if (isset($_POST['dekripsi'])) { 
                                    echo dekripsi($_POST['plain'], $_POST['key']); //memanggil fungsi dekripsi dan menampilkannya
                                } ?></b></td>
                    </tr>
                    <tr>
                        <!-- menampilkan text yang dimasukkan -->
                        <td>Text yang dimasukkan : </td>
                        <td><b>
                                <?php if (isset($_POST['enkripsi'])) { 
                                    echo dekripsi(enkripsi($_POST['plain'], $_POST['key']), $_POST['key']); //memanggil fungsi dekripsi yang sebelumnya dienkripsi dan menampilkannya
                                }
                                if (isset($_POST['dekripsi'])) { 
                                    echo enkripsi(dekripsi($_POST['plain'], $_POST['key']), $_POST['key']); //memanggil fungsi enripsi yang sebelumnya didekripsi dan menampilkannya
                                } ?></b></td>
                    </tr>
                    <tr>
                        <td>Key : </td>
                        <td><b><?php if (isset($_POST['enkripsi'])) { 
                                    echo $_POST['key']; //memanggil dan menampilkan key atau kunci geser
                                }
                                if (isset($_POST['dekripsi'])) { 
                                    echo $_POST['key']; //memanggil dan menampilkan key atau kunci geser
                                } ?></b></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    </form>

    <script>
        $(function() {
            $('.select2').select2()

        })
    </script>
</body>

</html>
<style>
    body {
        background-color: #a9a9a9;
    }

    .container {
        width: 40%;
        margin: 87px auto;
    }
</style>