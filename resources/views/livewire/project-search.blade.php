

<div class="min-h-screen bg-gradient-to-tr from-blue-100 via-indigo-100 to-purple-100 py-12">
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center gap-3 mb-10">
            <span class="bg-white/60 backdrop-blur-md rounded-full p-2 shadow-lg">
                <svg class="w-10 h-10 text-indigo-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            </span>
            <h1 class="text-3xl font-extrabold text-indigo-700 tracking-tight drop-shadow">โปรเจกต์ของคุณ</h1>
        </div>
        <div class="flex justify-center mb-8">
            <input wire:model.live="searchTerm" type="text" placeholder="🔍 ค้นหาโปรเจกต์..." class="w-full max-w-xl border-2 border-indigo-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-xl shadow-lg px-5 py-3 text-lg bg-white/80 backdrop-blur-md transition duration-200">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($projects as $project)
                <div class="bg-white/80 backdrop-blur-md rounded-2xl shadow-xl hover:scale-[1.03] hover:shadow-2xl transition-all duration-300 p-7 flex flex-col justify-between border border-indigo-100">
                    <div class="flex items-center gap-3 mb-3">
                        <span class="bg-indigo-100 rounded-full p-2">
                            <svg class="w-7 h-7 text-indigo-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-6a2 2 0 012-2h2a2 2 0 012 2v6m-6 0h6"/></svg>
                        </span>
                        <a href="#" class="text-xl font-bold text-indigo-800 hover:text-indigo-600 transition">{{ $project->name }}</a>
                    </div>
                    <div class="text-base text-gray-700 mb-4 font-medium">
                        {{ $project->description ?? 'ไม่มีรายละเอียด' }}
                    </div>
                    <div class="flex items-center justify-between mt-2">
                        <span class="px-4 py-1 inline-flex text-sm leading-6 font-bold rounded-full shadow
                            @if($project->status === 'completed') bg-green-100 text-green-800
                            @elseif($project->status === 'in_progress') bg-yellow-100 text-yellow-800
                            @else bg-gray-100 text-gray-800 @endif">
                            @if($project->status === 'completed') ✅ เสร็จสมบูรณ์
                            @elseif($project->status === 'in_progress') 🚧 กำลังพัฒนา
                            @else 📝 ฉบับร่าง @endif
                        </span>
                        <div class="flex gap-2 items-center">
                            @if($project->repository_link)
                                <a href="{{ $project->repository_link }}" target="_blank" class="text-blue-500 hover:underline flex items-center gap-1 font-semibold">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14 3v4a1 1 0 001 1h4m-5 13h-6a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v12a2 2 0 01-2 2z"/></svg>
                                    ดูโค้ด
                                </a>
                            @endif
                            <button class="bg-indigo-500 hover:bg-indigo-600 text-white px-3 py-1 rounded-lg shadow transition text-xs font-bold">ดูรายละเอียด</button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center text-gray-500 py-12">
                    <svg class="mx-auto mb-3 w-12 h-12 text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-6a2 2 0 012-2h2a2 2 0 012 2v6m-6 0h6"/></svg>
                    <span class="text-lg font-semibold">ไม่พบโปรเจกต์ที่ตรงกับคำค้นหา</span>
                </div>
            @endforelse
        </div>
    </div>
</div>

