<?php
         $aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'list';
         switch ($aksi):
             case "list":  
?>

        <h2>Tabel Users</h2>
        <a href="?p=user&aksi=input" class="btn-add mt-4 mb-4"><i class="fa-sharp fa-solid fa-plus"></i> User</a>
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
                         include ("../sikerma/database/koneksi.php");
                        
                        $no = 1;
                        $ambil = mysqli_query($conn, "SELECT * FROM tb_user");
                        while ($dataUser = mysqli_fetch_array($ambil)) :
                        ?>
                               <tr>
                                <td><?= $no ?></td>
                                <td><?= $dataUser['nama'] ?></td>
                                <td><?= $dataUser['username'] ?></td>
                                <td><?= $dataUser['email'] ?></td>
                                <td><?= $dataUser['password'] ?></td>                       
                                <td><?= $dataUser['level_user'] ?></td>
                                <td class="text-nowrap">
                                <a href="../../index.php?p=user&aksi=edit&id_edit=<?= $dataUser['id_user'] ?>" class="btn btn-warning"><i class="bi bi-pencil-fill"></i></a>
                                    <a href="/view/superadmin/proses_acount.php?proses=delete&id_hapus=<?= $dataUser['id_user'] ?>"
                                         class="btn btn-danger" onclick="return confirm('Yakin menghapus data?')"><i
                                         class="bi bi-trash"></i>
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

        case "input":
   ?>

                <!-- form user -->
                <div class="container">
                        <h2 class="text-center">Form Create Akun</h2>
                        
                        <form action="../view/superadmin/proses_acount.php?proses=insert" method="post">
                                <!-- nama user -->
                                <div class="mb-3">
                                <label for="nama_user">Nama User</label>
                                <input type="text" name="nama" id="nama_user" class="form-control" required>
                                </div>

                                <!-- username -->
                                <div class="mb-3">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" class="form-control" required>
                                </div>
                                
                                <!-- email -->
                                <div class="mb-3">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                                </div>
                                
                                <!-- password -->
                                <div class="mb-3">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                                </div>

                                <!-- role -->
                                <div class="mb-3">
                                <label for="role">Role</label>
                                <select name="level_user" id="role" class="form-control" required>
                                        <option value="">Pilih Role</option>
                                        <option value="superAdmin">superAdmin</option>
                                        <option value="admin">admin</option>
                                        <option value="mitra">mitra</option>
                                        <option value="jurusan">jurusan</option>
                                </select>
                                </div>
                                
                                <!-- submit -->
                                <button type="submit"  name="submit" class="btn btn-primary">Submit</button>
                        </form>
                </div>

        
        <?php
        break;
                case "edit":
                        include '../sikerma/database/koneksi.php';
                $edit = mysqli_query($conn, "SELECT * FROM tb_user WHERE id_user = '$_GET[id_edit]'");
                $dataUser = mysqli_fetch_array($edit); 
        ?>

        <!-- edit user -->
        <div class="container">
                        <h2 class="text-center"> Edit Akun</h2>
                        
                        <form action="../view/superadmin/proses_acount.php?proses=update" method="post">
                        <input type="number" name="id" id="id" class="form-control" value="<?=$dataUser['id_user'] ?>" hidden>
                                <!-- nama user -->
                                <div class="mb-3">
                                <label for="nama_user">Nama User</label>
                                <input type="text" name="nama" id="nama_user" class="form-control" value="<?=$dataUser['nama'] ?>" required>                               </div>

                                <!-- username -->
                                <div class="mb-3">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" class="form-control" value="<?=$dataUser['username'] ?>" required>
                                </div>
                                
                                <!-- email -->
                                <div class="mb-3">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="<?=$dataUser['email'] ?>" required>
                                </div>
                                
                                <!-- password -->
                                <div class="mb-3">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control" value="<?=$dataUser['password'] ?>" required>
                                </div>

                                <!-- role -->
                                <div class="mb-3">
                                        <label for="role">Role</label>
                                                <select name="level_user" id="role" class="form-control" required>
                                                        <option value="" disabled>-- Pilih Role --</option>
                                                                <?php
                                                                $roles = ["superAdmin", "admin", "mitra", "jurusan"];
                                                                $selected_role = isset($dataUser['level_user']) ? $dataUser['level_user'] : '';

                                                                foreach ($roles as $role) {
                                                                        $selected = ($role === $selected_role) ? "selected" : "";

                                                                        echo "<option value='" . htmlspecialchars($role) . "' $selected>" . htmlspecialchars($role) . "</option>";
                                                                }
                                                                ?>
                                                </select>

                                </div>
                                
                                <!-- submit -->
                                <button type="submit"  name="submit" class="btn btn-primary">Submit</button>
                        </form>
                </div>

<?php
        break;
        endswitch;
?>