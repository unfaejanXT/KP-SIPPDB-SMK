<div id="sidebar"
    class="fixed top-0 left-0 h-screen w-64 bg-gray-700 text-white transform translate-x-0 transition-transform duration-300 ease-in-out">
    <div class="flex items-center justify-center h-16 border-b border-gray-600">
        <h1 class="text-lg font-bold">Admin Panel</h1>
    </div>
    <div class="mt-4 overflow-y-auto h-[calc(100vh-4rem)]">
      <ul class="space-y-2">
         <li>
            <a href="{{route('admin.dashboard')}}" class="flex items-center px-4 py-2 hover:bg-gray-600">
               <i class="bi bi-house-door mr-3"></i> Dashboard
            </a>
         </li>
         <!-- <li>
            <a href="{{route('admin.profil')}}" class="flex items-center px-4 py-2 hover:bg-gray-600">
               <i class="bi bi-person mr-3"></i> Profil
            </a>
         </li> -->
         <div class="border-t border-gray-600 mt-4"></div>
         <li>
            <a href="{{route('admin.pengumuman')}}" class="flex items-center px-4 py-2 hover:bg-gray-600">
               <i class="bi bi-megaphone mr-3"></i> Kelola Pengumuman
            </a>
         </li>
         <li>
            <a href="{{ route('admin.periodeppdb') }}" class="flex items-center px-4 py-2 hover:bg-gray-600">
               <i class="bi bi-calendar-event mr-3"></i> Kelola Gelombang Pendaftaran
            </a>
         </li>

         <li>
            <a href="{{route('admin.jurusan')}}" class="flex items-center px-4 py-2 hover:bg-gray-600">
               <i class="bi bi-book mr-3"></i> Kelola Jurusan
            </a>
         </li>
         <div class="border-t border-gray-600 mt-4"></div>
         <li>
            <a href="{{route('admin.calonsiswa')}}" class="flex items-center px-4 py-2 hover:bg-gray-600">
               <i class="bi bi-person-lines-fill mr-3"></i> Kelola Data Calon Siswa
            </a>
         </li>
         <li>
            <a href="{{route('admin.berkas')}}" class="flex items-center px-4 py-2 hover:bg-gray-600">
               <i class="bi bi-file-earmark-check mr-3"></i> Verifikasi Berkas Calon Siswa
            </a>
         </li>
      </ul>
      <ul class="space-y-2 mt-4">
         <li>
            <a href="{{route('admin.rekapppdb')}}" class="flex items-center px-4 py-2 hover:bg-gray-600">
               <i class="bi bi-bar-chart mr-3"></i> Hasil Rekap PPDB
            </a>
         </li>
         <div class="border-t border-gray-600 mt-4"></div>
         <li>
            <a href="{{route('admin.kelolaakun')}}" class="flex items-center px-4 py-2 hover:bg-gray-600">
               <i class="bi bi-person-lock mr-3"></i> Pengaturan Akun
            </a>
         </li>
      </ul>
   </div>
</div>
