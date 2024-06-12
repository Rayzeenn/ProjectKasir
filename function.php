<?php

session_start();

$c = mysqli_connect('localhost', 'root', '', 'kasir');

if (isset($_POST['tambahbarang'])) {
	$namaproduk = $_POST['namaproduk'];
	$deskripsi = $_POST['deskripsi'];
	$harga = $_POST['harga'];
	$stock = $_POST['stock'];

	$insert = mysqli_query($c, "insert into produk (namaproduk, deskripsi, harga, stock) values ('$namaproduk','$deskripsi','$harga','$stock')");

	if ($insert) {
		header('location:stock.php');
	} else {
		echo '
		<script>alert("Gagal menambah barang baru");
		window.location.href="stock.php"
		</script>
		';
	}
}
if (isset($_POST['tambahpelanggan'])) {
	$namapelanggan = $_POST['namapelanggan'];
	$notelp = $_POST['notelp'];
	$alamat = $_POST['alamat'];

	$insert = mysqli_query($c, "insert into pelanggan (namapelanggan,notelp,alamat) values ('$namapelanggan','$notelp','$alamat')");

	if ($insert) {
		header('location:pelanggan.php');
	} else {
		echo '
		<script>alert("Gagal menambah pelanggan baru");
		window.location.href="pelanggan.php"
		</script>
		';
	}
}

if (isset($_POST['tambahpesanan'])) {
	$idpelanggan = $_POST['idpelanggan'];

	$insert = mysqli_query($c, "insert into pesanan (idpelanggan) values ('$idpelanggan')");

	if ($insert) {
		header('location:index.php');
	} else {
		echo '
		<script>alert("Gagal menambah pelanggan baru");
		window.location.href="index.php"
		</script>
		';
	}
}

if (isset($_POST['addproduk'])) {
	$idproduk = $_POST['idproduk'];
	$idp = $_POST['idp'];
	$qty = $_POST['qty'];

	$hitung1 = mysqli_query($c, "select * from produk where idproduk='$idproduk'");
	$hitung2 = mysqli_fetch_array($hitung1);
	$stocksekarang = $hitung2['stock'];

	if ($stocksekarang >= $qty) {
		$selisih = $stocksekarang - $qty;

		$insert = mysqli_query($c, "insert into detailpesanan (idpesanan,idproduk,qty) values ('$idp', '$idproduk', '$qty')");
		$update = mysqli_query($c, "update produk set stock='$selisih' where idproduk='$idproduk'");
		if ($insert && $update) {
			header('Location: view.php?idp=' . $idp);
		} else {
			echo '
			<script>alert("Gagal menambah produk baru");
			window.location.href="view.php?idp=' . $idp . '"
			</script>
			';
		}
	} else {
		echo '
		<script>alert("Gagal barang tidak cukup");
		window.location.href="view.php?idp=' . $idp . '"
		</script>
		';
	}
}

if (isset($_POST['barangmasuk'])) {
	$idproduk = $_POST['idproduk'];
	$qty = $_POST['qty'];

	$caristock = mysqli_query($c, "select * from produk where idproduk='$idproduk'");
	$caristock2 = mysqli_fetch_array($caristock);
	$stocksekarang = $caristock2['stock'];

	$newstock = $stocksekarang + $qty;

	$insertb = mysqli_query($c, "insert into masuk (idproduk,qty) values ('$idproduk', '$qty')");
	$updatetb = mysqli_query($c, "update produk set stock = '$newstock' where idproduk ='$idproduk'");

	if ($insertb && $updatetb) {
		header('location: masuk.php');
	} else {
		echo '
		<script>alert("Gagal");
		window.location.href= "masuk.php"
		</script>
		';
	}
}

if (isset($_POST['hapusprodukpesanan'])) {
	$idp = $_POST['idp'];
	$idpr = $_POST['idpr'];
	$idorder = $_POST['idorder'];

	$cek1 = mysqli_query($c, "select * from detailpesanan where iddetailpesanan = '$idp'");
	$cek2 = mysqli_fetch_array($cek1);
	$qtysekarang = $cek2['qty'];

	$cek3 = mysqli_query($c, "select * from produk where idproduk= '$idpr'");
	$cek4 = mysqli_fetch_array($cek3);
	$stocksekarang = $cek4['stock'];

	$hitung = $stocksekarang + $qtysekarang;

	$update = mysqli_query($c, "update produk set stock = '$hitung' where idproduk = '$idpr'");
	$hapus = mysqli_query($c, "delete from detailpesanan where idproduk = '$idpr' and iddetailpesanan = '$idp'");

	if ($update && $hapus) {
		header('location: view.php?id=' . $idorder);
	} else {
		echo '
		<script>alert("Gagal");
		window.location.href= "view.php?id=' . $idorder . '"
		</script>
		';
	}
}

if (isset($_POST['editbarang'])) {
	$np = $_POST['namaproduk'];
	$desc = $_POST['deskripsi'];
	$harga = $_POST['harga'];
	$idp = $_POST['idp'];

	$query = mysqli_query($c, "update produk set namaproduk='$np' , deskripsi='$desc', harga='$harga' where idproduk='$idp'");

	if ($query) {
		header('location:stock.php');
	} else {
		echo '
		<script>alert("Gagal");
		window.location.href= "stock.php";
		</script>
		';
	}
}

if (isset($_POST['hapusbarang'])) {
	$idp = $_POST['idp'];

	$query = mysqli_query($c, "delete from produk where idproduk='$idp'");

	if ($query) {
		header('location:stock.php');
	} else {
		echo '
		<script>alert("Gagal");
		window.location.href= "stock.php";
		</script>
		';
	}
}

if (isset($_POST['editpelanggan'])) {
	$np = $_POST['namapelanggan'];
	$nt = $_POST['notelp'];
	$alamat = $_POST['alamat'];
	$id = $_POST['idpl'];

	$query = mysqli_query($c, "update pelanggan set namapelanggan='$np' , notelp='$nt', alamat='$alamat' where idpelanggan='$id'");

	if ($query) {
		header('location:pelanggan.php');
	} else {
		echo '
		<script>alert("Gagal");
		window.location.href= "pelanggan.php";
		</script>
		';
	}
}

if (isset($_POST['hapuspelanggan'])) {
	$id = $_POST['idpl'];

	$query = mysqli_query($c, "delete from pelanggan where idpelanggan='$id'");

	if ($query) {
		header('location:pelanggan.php');
	} else {
		echo '
		<script>alert("Gagal");
		window.location.href= "pelangggan.php";
		</script>
		';
	}
}

if (isset($_POST['hapusbarangmasuk'])) {
	$idm = $_POST['idm'];

	$query = mysqli_query($c, "delete from masuk where idmasuk='$idm'");

	if ($query) {
		header('location:masuk.php');
	} else {
		echo '
		<script>alert("Gagal");
		window.location.href= "masuk.php";
		</script>
		';
	}
}

if (isset($_POST['hapuspesanan'])) {
	$idpesanan = $_POST['idpesanan'];

	$query = mysqli_query($c, "delete from pesanan where idpesanan='$idpesanan'");

	if ($query) {
		header('location:index.php');
	} else {
		echo '
		<script>alert("Gagal");
		window.location.href= "index.php";
		</script>
		';
	}
}

if (isset($_POST['editbarangpesanan'])) {
	$iddp = $_POST['iddp'];
	$qty_baru = $_POST['qty'];
	$idpesanan = $_POST['idpesanan'];

	// Ambil data lama dari detailpesanan untuk mengetahui qty sebelumnya
	$result = mysqli_query($c, "SELECT qty, idproduk FROM detailpesanan WHERE iddetailpesanan='$iddp'");
	$row = mysqli_fetch_assoc($result);
	$qty_lama = $row['qty'];
	$idproduk = $row['idproduk'];

	// Hitung selisih qty
	$selisih_qty = $qty_baru - $qty_lama;

	// Update tabel detailpesanan
	$query = mysqli_query($c, "UPDATE detailpesanan SET qty='$qty_baru' WHERE iddetailpesanan='$iddp'");

	if ($query) {
		// Update tabel produk
		$update_produk = mysqli_query($c, "UPDATE produk SET stock = stock - $selisih_qty WHERE idproduk='$idproduk'");

		if ($update_produk) {
			header('Location: view.php?idp=' . $idpesanan);
		} else {
			echo '
            <script>alert("Gagal memperbarui stock produk");
            window.location.href= "view.php?idp=' . $idpesanan . '";
            </script>
            ';
		}
	} else {
		echo '
        <script>alert("Gagal memperbarui detail pesanan");
        window.location.href= "view.php?idp=' . $idpesanan . '";
        </script>
        ';
	}
}
