<section class="bg-gray-100 p-6" x-data="formValidation()">

    <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-lg">
        <ol class="p-3 mb-3 items-center w-full space-y-4 sm:flex sm:space-x-8 sm:space-y-0 rtl:space-x-reverse">
            <li class="flex items-center text-blue-600 dark:text-blue-500 space-x-2.5 rtl:space-x-reverse">
                <span
                    class="flex items-center justify-center w-8 h-8 border border-blue-600 rounded-full shrink-0 dark:border-blue-500">
                    1
                </span>
                <span>
                    <h3 class="font-medium leading-tight">Formulir Pendaftaran</h3>
                    <p class="text-sm">Isi Biodata kamu dan Orangtua/Wali</p>
                </span>
            </li>
            <li class="flex items-center text-gray-500 dark:text-gray-400 space-x-2.5 rtl:space-x-reverse">
                <span
                    class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                    2
                </span>
                <span>
                    <h3 class="font-medium leading-tight">Unggah Berkas</h3>
                    <p class="text-sm">Siapkan berkas hasil scan dalam bentuk *pdf</p>
                </span>
            </li>
            <li class="flex items-center text-gray-500 dark:text-gray-400 space-x-2.5 rtl:space-x-reverse">
                <span
                    class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                    3
                </span>
                <span>
                    <h3 class="font-medium leading-tight">Cetak Kartu Pendaftaran</h3>
                    <p class="text-sm">Tahap Terakhir Pendaftaran Online</p>
                </span>
            </li>
        </ol>
        <h1 class="text-2xl font-bold mb-6 text-center">FORMULIR PPDB SMK SOLUSI BANGUN INDONESIA</h1>
        <form action="{{route('register.store')}}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="nisn" class="block text-sm font-medium text-gray-700">NISN</label>
                <input type="text" name="nisn" id="nisn" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div>
                <label for="nama_lengkap" class="block text-sm font-medium text-gray-700">Nama Calon Siswa
                    Baru</label>
                <input type="text" name="nama_lengkap" id="nama_lengkap" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div>
                <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>
            <div>
                <label for="tempat_lahir" class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" id="tempat_lahir" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <div>
                <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <div>
                <label for="agama" class="block text-sm font-medium text-gray-700">Agama</label>
                <select name="agama" id="agama" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
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
                <select name="golongan_darah" id="golongan_darah" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">Pilih Golongan Darah</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="AB">AB</option>
                    <option value="O">O</option>
                    <option value="null">Tidak Diketahui</option>
                </select>
            </div>
            <div class="col-span-2">
                <label for="alamat_rumah" class="block text-sm font-medium text-gray-700">Alamat Rumah</label>
                <textarea name="alamat_rumah" id="alamat_rumah" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm h-24"></textarea>
            </div>
            <div>
                <label for="rumah_milik" class="block text-sm font-medium text-gray-700">Rumah Milik</label>
                <select name="rumah_milik" id="rumah_milik" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">Pilih Kepemilikan</option>
                    <option value="Sendiri">Sendiri</option>
                    <option value="Kontrak/Sewa">Kontrak/Sewa</option>
                    <option value="Keluarga">Keluarga</option>
                </select>
            </div>
            <div>
                <label for="telepon_rumah" class="block text-sm font-medium text-gray-700">Telepon Rumah</label>
                <input type="text" name="telepon_rumah" id="telepon_rumah" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <div>
                <label for="nomor_hp" class="block text-sm font-medium text-gray-700">Nomor HP Calon Siswa</label>
                <input type="text" name="nomor_hp" id="nomor_hp" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <div>
                <label for="asal_sekolah" class="block text-sm font-medium text-gray-700">Asal SMP/MTs</label>
                <input type="text" name="asal_sekolah" id="asal_sekolah" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <div>
                <label for="nama_ayah" class="block text-sm font-medium text-gray-700">Nama Ayah</label>
                <input type="text" name="nama_ayah" id="nama_ayah" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <div>
                <label for="pekerjaan_ayah" class="block text-sm font-medium text-gray-700">Pekerjaan Ayah</label>
                <input type="text" name="pekerjaan_ayah" id="pekerjaan_ayah" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <div>
                <label for="nama_ibu" class="block text-sm font-medium text-gray-700">Nama Ibu</label>
                <input type="text" name="nama_ibu" id="nama_ibu" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <div>
                <label for="pekerjaan_ibu" class="block text-sm font-medium text-gray-700">Pekerjaan Ibu</label>
                <input type="text" name="pekerjaan_ibu" id="pekerjaan_ibu" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <div>
                <label for="nohp_orangtua" class="block text-sm font-medium text-gray-700">Nomor HP Calon
                    Siswa</label>
                <input type="text" name="nohp_orangtua" id="nohp_orangtua" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <div>
                <label for="nama_wali" class="block text-sm font-medium text-gray-700">Nama Wali</label>
                <input type="text" name="nama_wali" id="nama_wali" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <div>
                <label for="pekerjaan_wali" class="block text-sm font-medium text-gray-700">Pekerjaan Wali</label>
                <input type="text" name="pekerjaan_wali" id="pekerjaan_wali" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <div>
                <label for="nohp_wali" class="block text-sm font-medium text-gray-700">Nomor HP Orang
                    Tua/Wali</label>
                <input type="text" name="nohp_wali" id="nomor_hp_ortu_wali" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <div class="col-span-2">
                <label for="alamat_wali" class="block text-sm font-medium text-gray-700">Alamat Rumah Wali</label>
                <textarea name="alamat_wali" id="alamat_wali" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm h-24"></textarea>
            </div>

            <div class="mt-6">
                <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 px-4 rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Submit</button>
            </div>
        </form>
    </div>
</section>