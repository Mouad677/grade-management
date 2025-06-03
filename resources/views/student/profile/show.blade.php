<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mon Profil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-xl font-semibold mb-4">Informations Personnelles</h3>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Nom</label>
                                    <p class="mt-1 text-gray-900">{{ $user->last_name }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Prénom</label>
                                    <p class="mt-1 text-gray-900">{{ $user->first_name }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Code Étudiant</label>
                                    <p class="mt-1 text-gray-900">{{ $user->student_code }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Email</label>
                                    <p class="mt-1 text-gray-900">{{ $user->email }}</p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold mb-4">Actions</h3>
                            <div class="space-y-4">
                                <a href="{{ route('student.profile.edit') }}" 
                                   class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Modifier le mot de passe
                                </a>
                                <a href="{{ route('student.grades.index') }}" 
                                   class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                    Voir mes notes
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
