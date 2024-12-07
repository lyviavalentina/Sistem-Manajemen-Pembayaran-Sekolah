<?php
session_start();
if(isset($_SESSION['admin'])){
    include 'koneksi.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Slip Pembayaran</title>

        <style>
            body{
                font-family: arial;
            }

            table{
                border-collapse: collapse;
            }
        </style>
    </head>
    <body onload="window.print();">
        <h3>SMA BUDI PEKERTI<b><br/>LAPORAN PEMBAYARAN SPP</b></h3>
        <br/>
        <hr/>
        <?php
        $nisn = $_GET['nisn'];
        $siswa = mysqli_query($conn, "SELECT siswa.*, angkatan.*, jurusan.*, kelas.* FROM
            siswa, angkatan, jurusan, kelas WHERE siswa.id_angkatan = angkatan.id_angkatan AND siswa.
            id_jurusan = jurusan.id_jurusan AND siswa.id_kelas = kelas.id_kelas AND siswa.nisn = '$nisn'");
        $sw = mysqli_fetch_assoc($siswa);
        $idspp = $_GET['id'];
        ?>
        <table>
            <tr>
                <td>Nama Siswa</td>
                <td>:</td>
                <td><?= $sw['nama'] ?></td>
            </tr>
            <tr>
                <td>NISN</td>
                <td>:</td>
                <td><?= $sw['nisn'] ?></td>
            </tr>
            <tr>
                <td>Kelas</td>
                <td>:</td>
                <td><?= $sw['nama_kelas'] ?></td>
            </tr>
            <tr>
                <td>Angkatan</td>
                <td>:</td>
                <td><?= $sw['nama_angkatan'] ?></td>
            </tr>
            <tr>
                <td>Jurusan</td>
                <td>:</td>
                <td><?= $sw['nama_jurusan'] ?></td>
            </tr>
        </table>
        <hr>
        <table border="1" cellspacing="" cedllpadding="4" width="100%">
            <tr>
                <th>NO</th>
                <th>NO. BAYAR</th>
                <th>PEMBAYARAN BULAN</th>
                <th>JUMLAH</th>
                <th>KETERANGAN</th>
            </tr>
            <?php
            $spp = mysqli_query($conn, "SELECT siswa.*, pembayaran.* FROM siswa, pembayaran WHERE pembayaran.
            id_siswa = siswa.id_siswa AND pembayaran.idspp = '$idspp' ORDER BY nobayar ASC");
            $i=1;
            $total = 0;
            while($dta=mysqli_fetch_assoc($spp)) :
                ?>
            <tr>
                <td align="center"><?= $i ?></td>
                <td align=""><?= $dta['nobayar'] ?></td>
                <td align=""><?= $dta['bulan'] ?></td>
                <td align="right"><?= $dta['jumlah'] ?></td>
                <td align="center"><?= $dta['ket'] ?></td>
            </tr>
            <?php $i++; ?>
        <?php $total += $dta['jumlah']; ?>
        <?php endwhile; ?>
        <tr>
            <td colspan="4" align="right">TOTAL</td>
            <td align="right"><b><?= $total ?></td>
        </tr>
        </table>
        <table width="100%">
            <tr>
                <td></td>
                <td width="200px">
                    <br/>
                    <p>Palembang, <?= date('d/m/y') ?><br/>
                        Operator,
                        <br/>
                        <br/>
                        <br/>
                    </p>
                    <p>_________________________________</p>
                </td>
            </tr>
        </table>
    </body>
</html>
<?php
}else{
    header("location: loginauth.php");
}
?>
