<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project | Bahan Bakar</title>
    <style>
        body {
            text-align: center;
            margin: 0;
            padding: 0;
        }
        #container {
            width: 80%;
            margin: 0 auto;
        }
        form {
            margin-bottom: 20px;
        }
        
        @media screen and (max-width: 600px) {
            hr {
                width: 50%;
            }
        }
        label {
            display: block;
            margin-bottom: 10px;
        }

        input[for="jenis"], input[type="number"] {
            /* width: 100%; */
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        option {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            background-color: yellow;
            color: black;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #00FFFF;
            transition:1s;
        }
        </style>
</head>
<body>
    <div id="container">
        <h2>Form Pembelian Bahan Bakar</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="jenis">Jenis Bahan Bakar : </label>
        <select id="jenis" name="jenis">
            <option value="Shell Super">Shell Super</option>
            <option value="Shell V-Power">Shell V-Power</option>
            <option value="Shell V-Power Diesel">Shell V-Power Diesel</option>
            <option value="Shell V-Power Nitro">Shell V-Power Nitro</option>
</select>
<br></br>
        <label for="jumlah">Jumlah Liter : </label>
        <input type="number" id="jumlah" name="jumlah" min="0" step="1" placeholder= "Masukkan Jumlahnya"required>
<br></br>
        <button type="submit">Submit</button>
</form>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    class Shell {
        protected $jenis;
        protected $harga;
        protected $jumlah;
        protected $ppn;
        public function __construct($jenis, $harga, $jumlah) {
            $this->jenis = $jenis;
            $this->harga = $harga;
            $this->jumlah = $jumlah;
            $this->ppn = 10; // Buat PPN Menjadi 10%
        }
        public function getJenis() {
            return $this->jenis;
        }
        public function getHarga() {
            return $this->harga;
        }
        public function getJumlah() {
            return $this->jumlah;
        }
        public function getPPN() {
            return $this->ppn;
        }
    }
    class Beli extends Shell {
        public function hitungTotal() {
            $total = $this->harga * $this->jumlah;
            $total += $total * $this->ppn / 100;
            return $total;
        }
        public function buktiTransaksi() {
            $total = $this->hitungTotal();
            echo "<div style='text-align: center;'>";
            echo "---------------------------------";
            echo "<h3>Bukti Transaksi : </h3>";
            echo "<p><strong>Anda Membeli Bahan Bakar Minyak Dengan Tipe : </strong> " . $this->jenis . "</p>";
            echo "<p><strong>Dengan Jumlah : </strong> " . $this->jumlah . " Liter</p>";
            echo "<p><strong>Total Yang Harus Anda Bayar : </strong> Rp " . number_format($total,2,',','.') . "</p>";
            echo "---------------------------------";
            echo "</div>";
        }
    }
    $hargaBahanBakar = [
        "Shell Super" => 15420.00,
        "Shell V-Power" => 16130.00,
        "Shell V-Power Diesel" => 18310.00,
        "Shell V-Power Nitro" => 16510.00,
    ];
    $jenis = $_POST["jenis"];
    $jumlah = $_POST["jumlah"];
    if(array_key_exists($jenis, $hargaBahanBakar)) {
        $harga = $hargaBahanBakar[$jenis];
        $beli = new Beli($jenis, $harga, $jumlah);
        $beli->buktiTransaksi();
    } else {
        echo "<p style='text-align: center;'>Jenis Bahan Bakar Tidak Valid.</p>";
    }
}
?>
</html>