<div class="container">
        <h1>Form Pengajuan Kerjasama</h1>
        <form action="proses_pengajuan.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Nama Instansi: <span class="required">*</span></label>
                <input type="text" name="nama_instansi" placeholder="Masukkan nama instansi" required>
            </div>
            <div class="form-group">
                <label>Nama Penjabat: <span class="required">*</span></label>
                <input type="text" name="nama_penjabat" placeholder="Masukkan nama penjabat" required>
            </div>
            <div class="form-group">
                <label>Nama Jabatan: <span class="required">*</span></label>
                <input type="text" name="nama_jabatan" placeholder="Masukkan nama jabatan" required>
            </div>
            <div class="form-group">
                <label>Nama Kontak Person: <span class="required">*</span></label>
                <input type="text" name="nama_kontak_person" placeholder="Masukkan nama kontak person" required>
            </div>
            <div class="form-group">
                <label>Nomor Kontak: <span class="required">*</span></label>
                <input type="text" name="nomor_kontak" placeholder="Masukkan nomor kontak" required>
            </div>
            <div class="form-group">
                <label>Email: <span class="required">*</span></label>
                <input type="email" name="email" placeholder="Masukkan email" required>
            </div>
            <div class="form-group">
                <label>Alamat: <span class="required">*</span></label>
                <textarea name="alamat" placeholder="Masukkan alamat lengkap" required></textarea>
            </div>
            <div class="form-group">
                <label>Dokumen (PDF): <span class="required">*</span></label>
                <input type="file" name="dokumen_usulan" accept=".pdf" required>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>