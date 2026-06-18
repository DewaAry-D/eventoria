<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Admin
        </h2>
    </x-slot> --}}

    <x-app-layout>
        <div class="min-h-screen bg-surface flex flex-col md:flex-row">
            
            <x-admin.sidebar active="dashboard" />
    
            <main class="flex-1 min-w-0 overflow-y-auto max-w-container mx-auto ">
                
                {{-- Top Bar Section --}}
                <x-admin.topbar title="Dashboard Admin" />

                {{-- Main Menu Section --}}
                <div class="p-md lg:p-lg space-y-lg">
    
                    {{-- Title Page Start--}}
                    <x-admin.header-info 
                    title="Dashboard Overview" 
                    description="Selamat datang kembali, mari kelola aktivitas kampus hari ini."
                    downloadUrl="#" 
                    />
                    {{-- Title Page End--}}
                    
                    {{-- Stat Card Start --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-md items-start w-full">
                        <x-admin.card.stat-card-bento title="Organisasi Aktif" value="124" badge="+3%" badgeType="success" iconType="primary">
                            <x-slot name="icon">
                                <svg class="w-5 h-5" viewBox="0 0 24 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 21V0H11.6667V4.66667H23.3333V21H0ZM2.33333 18.6667H9.33333V16.3333H2.33333V18.6667ZM2.33333 14H9.33333V11.6667H2.33333V14ZM2.33333 9.33333H9.33333V7H2.33333V9.33333ZM2.33333 4.66667H9.33333V2.33333H2.33333V4.66667ZM11.6667 18.6667H21V7H11.6667V18.6667ZM14 11.6667V9.33333H18.6667V11.6667H14ZM14 16.3333V14H18.6667V16.3333H14Z" fill="#353E91"/>
                                </svg>
                            </x-slot>
                        </x-admin.card.stat-card-bento>

                        <x-admin.card.stat-card-bento title="Event Berlangsung" value="542" badge="+12%" badgeType="success" iconType="primary">
                            <x-slot name="icon">
                                <svg class="w-5 h-5" viewBox="0 0 21 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13.4167 18.6667C12.6 18.6667 11.9097 18.3847 11.3458 17.8208C10.7819 17.2569 10.5 16.5667 10.5 15.75C10.5 14.9333 10.7819 14.2431 11.3458 13.6792C11.9097 13.1153 12.6 12.8333 13.4167 12.8333C14.2333 12.8333 14.9236 13.1153 15.4875 13.6792C16.0514 14.2431 16.3333 14.9333 16.3333 15.75C16.3333 16.5667 16.0514 17.2569 15.4875 17.8208C14.9236 18.3847 14.2333 18.6667 13.4167 18.6667ZM2.33333 23.3333C1.69167 23.3333 1.14236 23.1049 0.685417 22.6479C0.228472 22.191 0 21.6417 0 21V4.66667C0 4.025 0.228472 3.47569 0.685417 3.01875C1.14236 2.56181 1.69167 2.33333 2.33333 2.33333H3.5V0H5.83333V2.33333H15.1667V0H17.5V2.33333H18.6667C19.3083 2.33333 19.8576 2.56181 20.3146 3.01875C20.7715 3.47569 21 4.025 21 4.66667V21C21 21.6417 20.7715 22.191 20.3146 22.6479C19.8576 23.1049 19.3083 23.3333 18.6667 23.3333H2.33333ZM2.33333 21H18.6667V9.33333H2.33333V21Z" fill="#56656E"/>
                                </svg>
                            </x-slot>
                        </x-admin.card.stat-card-bento>

                        <x-admin.card.stat-card-bento title="Pengajuan Event (ACC)" value="12" badge="High Priority" badgeType="error" iconType="error">
                            <x-slot name="icon">
                                <svg class="w-5 h-5" viewBox="0 0 23 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16.3333 24.5C14.7194 24.5 13.3438 23.9313 12.2063 22.7938C11.0688 21.6562 10.5 20.2806 10.5 18.6667C10.5 17.0528 11.0688 15.6771 12.2063 14.5396C13.3438 13.4021 14.7194 12.8333 16.3333 12.8333C17.9472 12.8333 19.3229 13.4021 20.4604 14.5396C21.5979 15.6771 22.1667 17.0528 22.1667 18.6667C22.1667 20.2806 21.5979 21.6562 20.4604 22.7938C19.3229 23.9313 17.9472 24.5 16.3333 24.5ZM18.2875 21.4375L19.1042 20.6208L16.9167 18.4333V15.1667H15.75V18.9L18.2875 21.4375ZM2.33333 23.3333C1.69167 23.3333 1.14236 23.1049 0.685417 22.6479C0.228472 22.191 0 21.6417 0 21V4.66667C0 4.025 0.228472 3.47569 0.685417 3.01875C1.14236 2.56181 1.69167 2.33333 2.33333 2.33333H7.20417C7.41806 1.65278 7.83611 1.09375 8.45833 0.65625C9.08055 0.21875 9.76111 0 10.5 0C11.2778 0 11.9729 0.21875 12.5854 0.65625C13.1979 1.09375 13.6111 1.65278 13.825 2.33333H18.6667C19.3083 2.33333 19.8576 2.56181 20.3146 3.01875C20.7715 3.47569 21 4.025 21 4.66667V11.9583C20.65 11.7056 20.2806 11.4917 19.8917 11.3167C19.5028 11.1417 19.0944 10.9861 18.6667 10.85V4.66667H16.3333V8.16667H4.66667V4.66667H2.33333V21H8.51667C8.65278 21.4278 8.80833 21.8361 8.98333 22.225C9.15833 22.6139 9.37222 22.9833 9.625 23.3333H2.33333ZM10.5 4.66667C10.8306 4.66667 11.1076 4.55486 11.3313 4.33125C11.5549 4.10764 11.6667 3.83056 11.6667 3.5C11.6667 3.16944 11.5549 2.89236 11.3313 2.66875C11.1076 2.44514 10.8306 2.33333 10.5 2.33333C10.1694 2.33333 9.89236 2.44514 9.66875 2.66875C9.44514 2.89236 9.33333 3.16944 9.33333 3.5C9.33333 3.83056 9.44514 4.10764 9.66875 4.33125C9.89236 4.55486 10.1694 4.66667 10.5 4.66667Z" fill="#BA1A1A"/>
                                </svg>
                            </x-slot>
                        </x-admin.card.stat-card-bento>

                        <x-admin.card.stat-card-bento title="Pengajuan Organisasi" value="5" badge="Pending" badgeType="neutral" iconType="info">
                            <x-slot name="icon">
                                <svg class="w-5 h-5" viewBox="0 0 24 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15.8083 19.1333L11.7833 15.1083L13.4167 13.475L15.8083 15.8667L21.7 9.975L23.3333 11.6083L15.8083 19.1333ZM9.33333 9.33333C8.05 9.33333 6.95139 8.87639 6.0375 7.9625C5.12361 7.04861 4.66667 5.95 4.66667 4.66667C4.66667 3.38333 5.12361 2.28472 6.0375 1.37083C6.95139 0.456944 8.05 0 9.33333 0C10.6167 0 11.7153 0.456944 12.6292 1.37083C13.5431 2.28472 14 3.38333 14 4.66667C14 5.95 13.5431 7.04861 12.6292 7.9625C11.7153 8.87639 10.6167 9.33333 9.33333 9.33333ZM12.6583 10.85L8.4 15.1083L11.9583 18.6667H0V15.4C0 14.7583 0.165278 14.1556 0.495833 13.5917C0.826389 13.0278 1.28333 12.6 1.86667 12.3083C2.85833 11.8028 3.97639 11.375 5.22083 11.025C6.46528 10.675 7.83611 10.5 9.33333 10.5C9.91667 10.5 10.4854 10.5292 11.0396 10.5875C11.5938 10.6458 12.1333 10.7333 12.6583 10.85Z" fill="#3B4951"/>
                                </svg>
                            </x-slot>
                        </x-admin.card.stat-card-bento>
                    </div>

                    {{-- Stat Card End --}}
                </div>
            
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900">
                                Selamat datang, {{ Auth::user()->adminKampus?->nama_admin ?? 'Admin' }}! Anda berhasil login sebagai Admin.
                            </div>
                        </div>
                    </div>
                </div>
            </main>
    
        </div>
    </x-app-layout>

    
</x-app-layout>