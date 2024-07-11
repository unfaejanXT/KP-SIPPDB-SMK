<section class="bg-gray-100 p-6">
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold mb-6">FORMULIR PPDB SMK SOLUSI BANGUN INDONESIA</h1>
        <form action="" method="POST" class="space-y-4">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700">Nama Calon Siswa Baru</label>
                    <input type="text" name="nama" id="nama"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div>
                    <label for="nisn" class="block text-sm font-medium text-gray-700">NISN</label>
                    <input type="text" name="nisn" id="nisn"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div>
                    <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis_kelamin"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div>
                    <label for="tempat_lahir" class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" id="tempat_lahir"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div>
                    <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div>
                    <label for="agama" class="block text-sm font-medium text-gray-700">Agama</label>
                    <select name="agama" id="agama"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        <option value="">Pilih Agama</option>
                        <option value="Islam">Islam</option>
                        <option value="Kristen">Kristen</option>
                        <option value="Katolik">Katolik</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Buddha">Buddha</option>
                        <option value="Konghucu">Konghucu</option>
                    </select>
                </div>
                <div>
                    <label for="golongan_darah" class="block text-sm font-medium text-gray-700">Golongan Darah</label>
                    <select name="golongan_darah" id="golongan_darah"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        <option value="">Pilih Golongan Darah</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="AB">AB</option>
                        <option value="O">O</option>
                    </select>
                </div>
                <div class="col-span-2">
                    <label for="alamat_rumah" class="block text-sm font-medium text-gray-700">Alamat Rumah</label>
                    <input type="text" name="alamat_rumah" id="alamat_rumah"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div>
                    <label for="rumah_milik" class="block text-sm font-medium text-gray-700">Rumah Milik</label>
                    <select name="rumah_milik" id="rumah_milik"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        <option value="">Pilih Kepemilikan</option>
                        <option value="Sendiri">Sendiri</option>
                        <option value="Kontrak/Sewa">Kontrak/Sewa</option>
                        <option value="Keluarga">Keluarga</option>
                    </select>
                </div>
                <div>
                    <label for="telepon_rumah" class="block text-sm font-medium text-gray-700">Telepon Rumah</label>
                    <input type="text" name="telepon_rumah" id="telepon_rumah"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div>
                    <label for="nomor_hp" class="block text-sm font-medium text-gray-700">Nomor HP Calon Siswa</label>
                    <input type="text" name="nomor_hp" id="nomor_hp"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div>
                    <label for="asal_smp" class="block text-sm font-medium text-gray-700">Asal SMP/MTs</label>
                    <input type="text" name="asal_smp" id="asal_smp"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div class="col-span-2">
                    <label for="alamat_asal_sekolah" class="block text-sm font-medium text-gray-700">Alamat Asal
                        Sekolah</label>
                    <input type="text" name="alamat_asal_sekolah" id="alamat_asal_sekolah"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div>
                    <label for="nama_ayah" class="block text-sm font-medium text-gray-700">Nama Ayah</label>
                    <input type="text" name="nama_ayah" id="nama_ayah"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div>
                    <label for="pekerjaan_ayah" class="block text-sm font-medium text-gray-700">Pekerjaan Ayah</label>
                    <input type="text" name="pekerjaan_ayah" id="pekerjaan_ayah"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div>
                    <label for="nama_ibu" class="block text-sm font-medium text-gray-700">Nama Ibu</label>
                    <input type="text" name="nama_ibu" id="nama_ibu"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div>
                    <label for="pekerjaan_ibu" class="block text-sm font-medium text-gray-700">Pekerjaan Ibu</label>
                    <input type="text" name="pekerjaan_ibu" id="pekerjaan_ibu"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div>
                    <label for="nama_wali" class="block text-sm font-medium text-gray-700">Nama Wali</label>
                    <input type="text" name="nama_wali" id="nama_wali"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div>
                    <label for="pekerjaan_wali" class="block text-sm font-medium text-gray-700">Pekerjaan Wali</label>
                    <input type="text" name="pekerjaan_wali" id="pekerjaan_wali"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div>
                    <label for="nomor_hp_ortu_wali" class="block text-sm font-medium text-gray-700">Nomor HP Orang
                        Tua/Wali</label>
                    <input type="text" name="nomor_hp_ortu_wali" id="nomor_hp_ortu_wali"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div class="col-span-2">
                    <label for="alamat_wali" class="block text-sm font-medium text-gray-700">Alamat Wali</label>
                    <input type="text" name="alamat_wali" id="alamat_wali"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
            </div>
            <div class="mt-6">
                <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 px-4 rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Submit</button>
            </div>
        </form>
    </div>
</section>
