@extends('layouts.app')

@section('content')
<div class="p-6 bg-gray-50 min-h-screen">

    <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow p-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Profile</h2>

        @if ($errors->any())
            <div class="mb-4">
                <div class="bg-red-50 border border-red-200 text-red-700 p-3 rounded">
                    <ul class="list-disc ml-5">
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-600 font-medium mb-1">Name</label>
                    <input type="text" name="name"
                        value="{{ old('name', $user->name) }}"
                        class="w-full rounded-xl border border-gray-300 p-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                </div>

                <div>
                    <label class="block text-gray-600 font-medium mb-1">Email</label>
                    <input type="email" name="email"
                        value="{{ old('email', $user->email) }}"
                        class="w-full rounded-xl border border-gray-300 p-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                </div>

                <div>
                    <label class="block text-gray-600 font-medium mb-1">Address</label>
                    <input type="text" name="address"
                        value="{{ old('address', $member->address ?? '') }}"
                        class="w-full rounded-xl border border-gray-300 p-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                </div>

                <div>
                    <label class="block text-gray-600 font-medium mb-1">Phone</label>
                    <input type="text" name="phone"
                        value="{{ old('phone', $member->phone ?? '') }}"
                        class="w-full rounded-xl border border-gray-300 p-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                </div>
            </div>

            <div>
                <label class="block text-gray-600 font-medium mb-2">Profile Picture</label>

                <div id="dropzone"
                     class="relative border-2 border-dashed border-gray-300 rounded-xl p-6 text-center cursor-pointer hover:border-indigo-400 transition">
                    <input type="file" name="profile_picture" id="fileInput" class="hidden" accept="image/*">

                    <div class="flex flex-col items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 15a4 4 0 014-4h10a4 4 0 014 4M16 7l-4-4m0 0L8 7m4-4v12" />
                        </svg>
                        <p class="text-gray-500">Drag & drop an image here, or click to select</p>
                        <p class="text-xs text-gray-400 mt-1">PNG, JPG or JPEG (max 2MB)</p>
                    </div>
                </div>

                <div class="mt-4 flex items-center gap-4">
                    <img id="preview" src="{{ ($member && $member->profile_picture) ? asset('storage/profile_pictures/' . $member->profile_picture) : asset('default-avatar.png') }}"
                         class="w-24 h-24 rounded-full object-cover border" alt="preview">
                    <div class="text-sm text-gray-600">
                        <div class="font-medium">{{ $user->name }}</div>
                        <div class="text-gray-400">{{ $user->email }}</div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-600 font-medium mb-1">New Password (optional)</label>
                    <input type="password" name="password"
                        class="w-full rounded-xl border border-gray-300 p-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                </div>

                <div>
                    <label class="block text-gray-600 font-medium mb-1">Confirm Password</label>
                    <input type="password" name="password_confirmation"
                        class="w-full rounded-xl border border-gray-300 p-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-2">
                <a href="{{ route('user.profile') }}" class="px-5 py-2 bg-gray-200 text-gray-700 rounded-xl hover:bg-gray-300 transition">Cancel</a>
                <button type="submit" class="px-5 py-2 bg-green-600 text-white rounded-xl hover:bg-green-700 transition">Save Changes</button>
            </div>
        </form>
    </div>

</div>

<script>
    (function () {
        const dropzone = document.getElementById('dropzone');
        const fileInput = document.getElementById('fileInput');
        const preview = document.getElementById('preview');

        if (!dropzone || !fileInput) return;

        dropzone.addEventListener('click', () => fileInput.click());

        dropzone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropzone.classList.add('border-indigo-400', 'bg-indigo-50');
        });

        dropzone.addEventListener('dragleave', (e) => {
            dropzone.classList.remove('border-indigo-400', 'bg-indigo-50');
        });

        dropzone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropzone.classList.remove('border-indigo-400', 'bg-indigo-50');

            const files = e.dataTransfer.files;
            if (!files || files.length === 0) return;

            fileInput.files = files;
            showPreview(files[0]);
        });

        fileInput.addEventListener('change', (e) => {
            if (!e.target.files || !e.target.files[0]) return;
            showPreview(e.target.files[0]);
        });

        function showPreview(file) {
            if (!file) return;
            const reader = new FileReader();
            reader.onload = (e) => {
                preview.src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    })();
</script>
@endsection
