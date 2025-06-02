@extends('admin.app')
@section('title', 'Profile')

@section('content')
    <section class="bg-white dark:bg-gray-900 rounded-lg shadow-md min-h-[calc(100vh-8rem)] p-4 md:p-6">
        <div class="mx-auto max-w-6xl">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Profile Settings</h2>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Left Card - Profile Information -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-semibold text-gray-800 dark:text-white">Profile Information</h3>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Full Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            @error('name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Role</label>
                            <div
                                class="px-4 py-2 border border-gray-300 text-black rounded-lg bg-gray-100 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <span class="capitalize">{{ $user->role }}</span>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Phone
                                Number</label>
                            <input type="text" id="phone_number" name="phone_number"
                                value="{{ old('phone_number', $user->phone_number) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            @error('phone_number')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Right Card - Account Settings -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6">
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-6">Account Settings</h3>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email
                                Address</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                                readonly
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">New
                                Password</label>
                            <div class="relative">
                                <input type="password" id="password" name="password"
                                    placeholder="Kosongkan jika tidak ingin mengubah"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <button type="button" onclick="togglePasswordVisibility('password')"
                                    class="absolute inset-y-0 right-0 flex items-center px-4 text-gray-600 dark:text-gray-300 hover:text-gray-800 dark:hover:text-white">
                                    <i class="far fa-eye"></i>
                                </button>
                            </div>
                            @error('password')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Confirm
                                Password</label>
                            <div class="relative">
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <button type="button" onclick="togglePasswordVisibility('password_confirmation')"
                                    class="absolute inset-y-0 right-0 flex items-center px-4 text-gray-600 dark:text-gray-300 hover:text-gray-800 dark:hover:text-white">
                                    <i class="far fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end">
                        <button type="button" onclick="submitForm()"
                            class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary-light focus:ring-offset-2 transition-colors duration-200 dark:hover:bg-secondary-dark dark:focus:ring-secondary-light">
                            Save Changes
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function togglePasswordVisibility(fieldId) {
            const input = document.getElementById(fieldId);
            const eyeIcon = input.nextElementSibling.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                eyeIcon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                eyeIcon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }

        function submitForm() {
            const formData = {
                name: document.getElementById('name').value,
                email: document.getElementById('email').value,
                phone_number: document.getElementById('phone_number').value,
                password: document.getElementById('password').value,
                password_confirmation: document.getElementById('password_confirmation').value,
                _token: '{{ csrf_token() }}',
                _method: 'PUT'
            };

            fetch('{{ route('admin.profile.update') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(formData)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: data.message,
                            timer: 2000,
                            showConfirmButton: false
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Something went wrong!',
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'An error occurred while updating your profile.',
                    });
                    console.error('Error:', error);
                });
        }
    </script>
@endsection
