<?php
         $aksi = isset($_POST['aksi']) ? $_GET['aksi'] : 'list';
         switch ($aksi) :
             case "list":  
?>

        <h2>Tabel Users</h2>
        <a href="" class="btn btn-primary mb-2">Tambah User</a>
        <table id="tabel-user" class="table table-bordered table-striped">
                <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Level</th>
                            <th>Aksi</th>
                        </tr>
                </thead>
            <tbody>
                        <?php
                        $conn = include '../../database/koneksi.php';
                        
                        $no = 1;
                        $ambil = mysqli_query($koneksi, "SELECT * FROM tb_user");
                        while ($dataUser = mysqli_fetch_array($ambil)) :
                        ?>
                               <tr>
                                <td><?= $no ?></td>
                                <td><?= $dataUser['nama'] ?></td>
                                <td><?= $dataUser['username'] ?></td>
                                <td><?= $dataUser['email'] ?></td>
                                <td><?= $dataUser['password'] ?></td>                       
                                <td><?= $dataUser['level'] ?></td>
                                <td>
                                    <a href="index.php?p=mhs&aksi=edit&id_edit=<?= $dataUser['id_user'] ?>" class="btn btn-warning">Edit</a>
                                    <a href="proses_data_mou_moa.php?proses=delete&id_hapus=<?= $dataUser['id_user'] ?>" class="btn btn-danger" onclick="return confirm('Yakin akan menghapus data?')">Hapus</a>
                                </td>
                            </tr>
                   <?php
                        $no++;
                        endwhile;
                    ?>
               </tbody>
        </table>


   <?php
        break;

        case "input";
   ?>

                <!-- form user -->
                <div class="container">
                <h2 class="text-center">Form Create Akun</h2>
                
                <form action="proses_data_mou_moa.php?proses=insert" method="post">
                        <!-- nama user -->
                        <div class="mb-3">
                                <label for="nama-user">Nama User</label>
                                <input type="text" name="nama-user" id="nama-user" class="from-control" required>
                        </div>

                        <!-- username -->
                        <div class="mb-3">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" class="from-control" required>
                        </div>
                        
                        <!-- email -->
                        <div class="mb-3">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="from-control" required>
                        </div>
                        
                        <!-- password -->
                        <div class="mb-3">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="from-control" required>
                        </div>

                        <!-- role -->
                        <div class="mb-3">
                                <label for="role">Role</label>
                                <select name="role" id="role" class="form-control" required>
                                        <option value="">Pilih Role</option>
                                        <option value="1">superadmin</option>
                                        <option value="2">admin</option>
                                        <option value="3">mitra</option>
                                        <option value="4">jurusan</option>
                                </select>
                        </div>
                        
                        <!-- submit -->
                        <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                </div>
        
        <?php
                case "edit":
                include "../../database/koneksi.php";
                $edit = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE id_user = '$_GET[id_user]'");
                $dataUser = mysqli_fetch_array($edit); 
        ?>

        <!-- edit user -->
        <div class="container">
                <h2 class="text-center">Form Create Akun</h2>
                
                <form action="proses_data_mou_moa.php?proses=insert" method="post">
                <input type="number" name="id" id="id" class="form-control" value="<?=$dataUser['id_user'] ?>" hidden>
                        
                        <!-- nama user -->
                        <div class="mb-3">
                                <label for="nama-user">Nama User</label>
                                <input type="text" name="nama-user" id="nama-user" class="from-control" value="<?=$dataUser['nama'] ?>" required>
                        </div>

                        <!-- username -->
                        <div class="mb-3">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" class="from-control" value="<?=$dataUser['username'] ?>" required>
                        </div>
                        
                        <!-- email -->
                        <div class="mb-3">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="from-control" value="<?=$dataUser['email'] ?>" required>
                        </div>
                        
                        <!-- password -->
                        <div class="mb-3">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="from-control" value="<?=$dataUser['password'] ?>" required>
                        </div>

                        <!-- role -->
                        <div class="mb-3">
                                <label for="role">Role</label>
                                <select name="role" id="role" class="form-control" required>
                                        <?php
                                        // Mengambil data dari database
                                                include '../../database/koneksi.php';
                                                $query = mysqli_query($koneksi, "SELECT level_user FROM tb_user");
                                                while ($row = mysqli_fetch_assoc($query)) {
                                        ?>
                                            <option value="<?= $row['id_mou_moa'] ?>"><?= $row['keterangan'] ?></option>
                                        <?php
                                        }
                                        ?>
                                </select>
                        </div>
                        
                        <!-- submit -->
                        <button type="submit" class="btn btn-primary">Submit</button>
                </form>
        </div>

<?php
        break;
        endswitch;
?>