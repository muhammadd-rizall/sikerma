<div class="container">
    <h2 class="text-center">Form Create Akun</h2>
    
    <form action="" method="">
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