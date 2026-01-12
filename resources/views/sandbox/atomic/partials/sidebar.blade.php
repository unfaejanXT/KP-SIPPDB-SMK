<aside class="w-64 flex-shrink-0 bg-[#0F1115] border-r border-gray-800 flex flex-col transition-all duration-300">
    <!-- Sidebar Header -->
    <div class="h-16 flex items-center px-6 border-b border-gray-800">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-indigo-600 flex items-center justify-center text-white">
                <i class="bi bi-flower1"></i>
            </div>
            <div>
                <h1 class="text-white font-bold text-sm tracking-wide">Atomic Design</h1>
                <p class="text-[10px] text-gray-500 uppercase tracking-widest">Reference Components</p>
            </div>
        </div>
    </div>

    <!-- Sidebar Navigation -->
    <nav class="flex-1 overflow-y-auto px-3 py-6">
        <!-- Section Label -->
        <div class="px-3 mb-2">
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Categories</p>
        </div>

        <div class="space-y-1">
            <!-- Atoms (Active) -->
            <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg bg-[#1C1E24] text-white group relative">
                <!-- Active Indicator -->
                <div class="absolute left-0 w-1 h-6 bg-green-500 rounded-r-full hidden"></div>
                
                <div class="w-6 h-6 rounded flex items-center justify-center bg-green-500 text-white shrink-0">
                    <i class="bi bi-grid-fill text-xs"></i>
                </div>
                <span class="text-sm font-medium">Atoms</span>
            </a>

            <!-- Molecules -->
            <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-400 hover:text-white hover:bg-[#1C1E24] transition-colors group">
                <div class="w-6 h-6 rounded flex items-center justify-center bg-gray-800 text-gray-400 group-hover:bg-gray-700 transition-colors shrink-0">
                    <i class="bi bi-share-fill text-xs"></i>
                </div>
                <span class="text-sm font-medium">Molecules</span>
            </a>

            <!-- Organisms -->
            <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-400 hover:text-white hover:bg-[#1C1E24] transition-colors group">
                <div class="w-6 h-6 rounded flex items-center justify-center bg-gray-800 text-gray-400 group-hover:bg-gray-700 transition-colors shrink-0">
                    <i class="bi bi-box-fill text-xs"></i>
                </div>
                <span class="text-sm font-medium">Organisms</span>
            </a>

            <!-- Templates -->
            <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-400 hover:text-white hover:bg-[#1C1E24] transition-colors group">
                <div class="w-6 h-6 rounded flex items-center justify-center bg-gray-800 text-gray-400 group-hover:bg-gray-700 transition-colors shrink-0">
                        <i class="bi bi-layout-text-window-reverse text-xs"></i>
                </div>
                <span class="text-sm font-medium">Templates</span>
            </a>

            <!-- Pages -->
            <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-400 hover:text-white hover:bg-[#1C1E24] transition-colors group">
                <div class="w-6 h-6 rounded flex items-center justify-center bg-gray-800 text-gray-400 group-hover:bg-gray-700 transition-colors shrink-0">
                    <i class="bi bi-file-earmark-text-fill text-xs"></i>
                </div>
                <span class="text-sm font-medium">Pages</span>
            </a>
        </div>
    </nav>

        <!-- Sidebar Footer -->
    <div class="p-4 border-t border-gray-800">
        <p class="text-[10px] text-gray-600">Based on Brad Frost's <a href="https://atomicdesign.bradfrost.com/" target="_blank" class="text-blue-500 hover:underline">Atomic Design</a></p>
    </div>
</aside>
