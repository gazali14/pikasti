<x-layout-kader>
    <div class="p-2 min-h-screen max-h-96">
        <div class="text-center my-4">
            <h1 class="text-3xl font-bold mx-5">Pemberian Vitamin</h1>
        </div>
        <div class="p-2 bg-[rgba(191,243,221,0.8)] rounded shadow">
            <x-tabel-vitamin :bayiList="$bayiList" :vitaminData="$vitaminData" :selectedBayiNik="$selectedBayiNik" />

        </div>
    </div>
</x-layout-kader>
