<!-- resources/views/components/navigation.blade.php -->

<nav class="bg-white border-b border-gray-200 px-4 py-3 flex items-center">
    <!-- Tombol Hamburger -->
    <button id="toggleSidebar" class="text-gray-500 focus:outline-none mr-4">
        <i class="bi bi-list text-2xl"></i>
    </button>

    <!-- Menampilkan Label Submenu -->
    <span class="text-gray-800 font-semibold text-lg">
            @yield('navlabel', '')  <!-- Default 'Dashboard' jika tidak ada section -->
    </span>
</nav>
