<div class="form-container">
    <h2>Form Pengajuan Usulan Kerjasama</h2>
    <form action="proses_pengajuan.php" method="POST" enctype="multipart/form-data">
        <label for="nama_instansi">Nama Instansi</label>
        <input type="text" name="nama_instansi" required>

        <label for="alamat">Alamat</label>
        <textarea name="alamat" rows="3" required></textarea>

        <label for="penandatangan">Nama Pejabat Penandatangan</label>
        <input type="text" name="penandatangan" required>

        <label for="jabatan">Nama Jabatan</label>
        <input type="text" name="jabatan" required>

        <label for="kontak_person">Nama Kontak Person</label>
        <input type="text" name="kontak_person" required>

        <label for="nomor_kontak">Nomor Kontak</label>
        <input type="text" name="nomor_kontak" required>

        <label for="email">Email</label>
        <input type="email" name="email" required>

        <label for="dokumen">Upload Dokumen Usulan</label>
        <input type="file" name="dokumen" required>

        <button type="submit">Submit</button>
    </form>
</div>