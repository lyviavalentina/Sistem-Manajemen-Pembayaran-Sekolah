<?php include 'header.php';
include 'koneksi.php';

if(isset($_GET['id_jurusan'])){
  $id_jurusan = $_GET['id_jurusan'];
  $exec = mysqli_query($conn, "DELETE FROM jurusan WHERE id_jurusan='$id_jurusan'");
  if($exec){
    echo "<script>alert('data jurusan berhasil dihapus')
    document.location = 'editdatajurusan.php' </script>;";
  }else{
    echo "<script>alert('data jurusan gagal dihapus')
    document.location = 'editdatajurusan.php' </script>;";
  }
}

?>

<!-- button triger -->
<button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah Data</button>
<!-- button triger -->
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Jurusan</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Jurusan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <?php 
                                    $no=1;
                                    $query = "SELECT * FROM jurusan";
                                    $exec = mysqli_query($conn, $query);
                                    while($res = mysqli_fetch_assoc($exec)) :
                                    
                                    ?>
                                    <tbody>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $res['nama_jurusan'] ?></td>
                                            <td>
                                                <a href="editdatajurusan.php?id_jurusan=<?= $res['id_jurusan'] ?>"
                                                class="btn btn-sm btn-danger" onclick="return confirm('Apakah 
                                                Yakin Ingin Menghapus Data?') ">Hapus</a>
                                                <a href="#" class="view_data btn btn-sm btn-warning"
                                                data-bs-toggle="modal" data-bs-target="#myModal" id="
                                                <?php echo $res['id_jurusan']; ?>">Edit</a>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Data Jurusan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
      </div>
      <div class="modal-body">
        <form action="" method="POST">
            <input type="text" name="nama_jurusan" placeholder="Nama Jurusan" class="form-control mb-2">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="Submit" name="simpan" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal edit data jurusan -->
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleMOdalLabel">Edit Data Jurusan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
      </div>
      <div class="modal-body" id="datajurusan">
      </div>
    </div>
  </div>
</div>

<?php

if(isset($_POST['simpan'])){
  $nama_jurusan = htmlentities(strip_tags(strtoupper($_POST['nama_jurusan'])));
  
  $query = "INSERT INTO jurusan (nama_jurusan) VALUES('$nama_jurusan')";
  $exec = mysqli_query($conn, $query);
  if($exec){
    echo "<script>alert('data jurusan berhasil disimpan')
    document.location = 'editdatajurusan.php';
    </script>";
  }else{
    echo "<script>alert('data jurusan gagal disimpan')
    document.location = 'editdatajurusan.php';
    </script>";
  }
}
?>
<?php include 'footer.php';?>

<script type="text/javascript">
  $('.view_data').click(function(){
    var id_jurusan = $(this).attr('id');
    $.ajax({
      url: 'view.php',
      method: 'post',
      data: {id_jurusan:id_jurusan},
      success:function(data){
        $('#datajurusan').html(data)
        $('#myModal').modal('show');
      }
    })
  })
</script>

<?php
if(isset($_POST['edit'])){
  $id_jurusan = $_POST['id_jurusan'];
  $nama_jurusan = htmlentities(strip_tags(strtoupper($_POST['nama_jurusan'])));
  $query = "UPDATE jurusan SET nama_jurusan = '$nama_jurusan' WHERE id_jurusan = '$id_jurusan'";
  
  $exec = mysqli_query($conn, $query);
  if($exec){
    echo "<script>alert('data jurusan berhasil diedit')
    document.location = 'editdatajurusan.php' </script>;";
  }else{
    echo "<script>alert('data jurusan gagal diedit')
    document.location = 'editdatajurusan.php' </script>;";
  }
}
?>