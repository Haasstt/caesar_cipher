<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Caesar Cipher</h1>
	
</div>

<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-xl-8 col-lg-12 col-md-9">

  			<div class="card o-hidden border-0 shadow-lg my-3">
  			  <div class="card-body p-0">
      				<div class="row">
      				  <div class="col-lg-12">
      				    <div class="p-5">
      				      <div>
								<h1 class="h1 text-gray-900 mb-4 text-center">Form Enkripsi dan Deskripsi</h1>       
                                <!--form input text dan key -->
								<form class="user" method="POST"> 
							        <div class="form-group">
								        <input id="username" type="text" name="input_text" class="form-control form-control-user" placeholder="Masukkan text" required>
							        </div>
							        <div class="form-group">
								        <input id="username" type="number" name="input_key" class="form-control form-control-user" placeholder="key" required>
							        </div>
								        <input type="submit" name="enkripsi" value="Enkripsi" class="btn btn-danger btn-user">
								        <input type="submit" name="deskripsi" value="Deskripsi" class="btn btn-success btn-user">
							        <hr>
						        </form>

							  	<h1 class="h6 text-gray-900 mb-4 fw-blod">Output : </h1> 
								<!-- output hasil enkripsi dan deskripsi -->
                                <div class="my-2">
<?php 
	
	function cipher($char, $key){ //membuat fungsi cipher
		if (ctype_alpha($char)) { //cek alphabet atau tidak
			$nilai = ord(ctype_upper($char) ? 'A' : 'a'); 
			$ch = ord($char); //konvensi ke karakter ASCII
			$mod = fmod($ch + $key - $nilai, 26); //perhitangan modulus
			$hasil = chr($mod + $nilai);  //hasil modulus ditambah dengan nilai dan konversi ke bentuk alphabet
			return $hasil; 
		} else { //mengebalikan nilai inputan jika selain alphabet
			return $char;
		}
	}

    if(isset($_POST['enkripsi'])){ //cek enkripsi
        $text_input = $_POST['input_text']; //deklarasi text inputan
		$kunci = $_POST['input_key']; //deklarasi number key

		$chars = str_split($text_input); //variabel untuk menampung data yang diinput
        $enkripsi = ""; //variable penampung enkripsi

		foreach ($chars as $char) { //perulangan untuk menampilkan data array
			$enkripsi .= cipher($char, $kunci); //menjalankan fungsi cipher
		}

		$chars_enkripsi = str_split($enkripsi); //variabel untuk menampung data yang dienkripsi untuk dideskripsikan
		$deskripsi = ""; //variable penampung deskripsi

		foreach ($chars_enkripsi as $char) { //perulangan untuk menampilkan data array
			$deskripsi .= cipher($char, 26 - $kunci); //mengembalikan fungsi cipher
		}

		//pemanggilan variable untuk ditampilkan di output
        echo "	
            	<p> Hasil enkripsi : <strong>"."$enkripsi"."</strong></p> 
				<p> Text yang dienkripsi : <strong>"."$deskripsi"."</strong></p>
				<p> Key : <strong>"."$kunci"."</strong></p>
        ";

    }
    if(isset($_POST['deskripsi'])){ //cek enkripsi
        $text_input = $_POST['input_text']; //deklarasi text inputan
		$kunci = $_POST['input_key']; //deklarasi number key

		$chars = str_split($text_input); //variabel untuk menampung data yang diinput
        $deskripsi = ""; //variable penampung deskripsi

		foreach ($chars as $char) { //perulangan untuk menampilkan data array
			$deskripsi .= cipher($char, 26 - $kunci); //mengembalikan fungsi cipher
		}

		$chars_enkripsi = str_split($deskripsi); //variabel untuk menampung data yang dienkripsi untuk dienkripsikan
		$enkripsi = ""; //variable penampung enkripsi

		foreach ($chars_enkripsi as $char) { //perulangan untuk menampilkan data array
			$enkripsi .= cipher($char, $kunci); //menjalankan fungsi cipher
		}

		//pemanggilan variable untuk ditampilkan di output
        echo "	
            	<p> Hasil deskripsi : <strong>"."$deskripsi"."</strong></p>
				<p> Text yang dideskripsi : <strong>"."$enkripsi"."</strong></p>
				<p> Key : <strong>"."$kunci"."</strong></p>
        ";

    }
?>
                                </div> 

            			  </div>
      				    </div>
         			  </div>
        			</div>
             </div>
            </div>
  
		</div>
	</div>
</div>