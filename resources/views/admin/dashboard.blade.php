<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tableau de bord') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-blue-100 p-6 rounded-lg">
                        <h3 class="text-xl font-bold text-blue-800">Utilisateurs</h3>
                        <p class="mt-2 text-blue-600">Gérer les utilisateurs du système</p>
                        <a href="{{ route('admin.users.index') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            Accéder
                        </a>
                    </div>
                    <div class="bg-green-100 p-6 rounded-lg">
                        <h3 class="text-xl font-bold text-green-800">Notes</h3>
                        <p class="mt-2 text-green-600">Importer et gérer les notes</p>
                        <a href="{{ route('grades.upload') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                            Accéder
                        </a>
                    </div>
                    <div class="bg-purple-100 p-6 rounded-lg">
                        <h3 class="text-xl font-bold text-purple-800">Profil</h3>
                        <p class="mt-2 text-purple-600">Modifier vos informations personnelles</p>
                        <a href="{{ route('profile.edit') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700">
                            Accéder
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
