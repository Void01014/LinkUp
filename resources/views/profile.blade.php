<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        /* font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 40px 20px; */
    }

    .container {
        max-width: 800px;
        margin: 0 auto;
    }

    .profile-header {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 24px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        padding: 40px;
        margin-bottom: 24px;
        animation: slideIn 0.5s ease-out;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .profile-top {
        display: flex;
        align-items: center;
        gap: 24px;
        margin-bottom: 32px;
    }

    .avatar {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, #4ade80 0%, #3b82f6 100%);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 42px;
        color: white;
        font-weight: 600;
        flex-shrink: 0;
    }

    .profile-info {
        flex: 1;
    }

    .profile-info h1 {
        color: #1e293b;
        font-size: 32px;
        font-weight: 600;
        margin-bottom: 4px;
        letter-spacing: -0.5px;
    }

    .profile-info p {
        color: #64748b;
    }

    .profile-form {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 24px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        padding: 40px;
        animation: slideIn 0.6s ease-out;
    }

    .section-title {
        color: #1e293b;
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 24px;
        letter-spacing: -0.3px;
    }

    .form-group {
        margin-bottom: 24px;
    }

    label {
        display: block;
        color: #475569;
        font-size: 14px;
        font-weight: 500;
        margin-bottom: 8px;
        letter-spacing: 0.2px;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"],
    textarea {
        width: 100%;
        padding: 14px 16px;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        font-size: 15px;
        color: #1e293b;
        transition: all 0.3s ease;
        background: #f8fafc;
        font-family: inherit;
    }

    input[type="text"]:focus,
    input[type="email"]:focus,
    input[type="password"]:focus,
    textarea:focus {
        outline: none;
        border-color: #4ade80;
        background: white;
        box-shadow: 0 0 0 4px rgba(74, 222, 128, 0.1);
    }

    textarea {
        min-height: 120px;
        resize: vertical;
    }

    .password-field {
        position: relative;
    }

    .password {
        position: absolute;
        right: 16px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #64748b;
        cursor: pointer;
        font-size: 14px;
        padding: 4px 8px;
        transition: color 0.2s;
    }

    .password:hover {
        color: #3b82f6;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .btn-group {
        display: flex;
        gap: 12px;
        margin-top: 32px;
    }
    
    .btn {
        flex: 1;
        padding: 14px;
        border: none;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        font-family: inherit;
    }

    .btn-primary {
        background: linear-gradient(135deg, #4ade80 0%, #3b82f6 100%);
        color: white;
        box-shadow: 0 4px 12px rgba(74, 222, 128, 0.3);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(74, 222, 128, 0.4);
    }

    .btn-secondary {
        background: white;
        color: #475569;
        border: 2px solid #e2e8f0;
    }

    .btn-secondary:hover {
        background: #f8fafc;
        border-color: #cbd5e1;
    }

    .btn:active {
        transform: translateY(0);
    }

    .helper-text {
        color: #64748b;
        font-size: 13px;
        margin-top: 6px;
    }

    .error {
        color: #ef4444;
        font-size: 13px;
        margin-top: 4px;
        display: block;
    }

    .success-message {
        background: #d1fae5;
        border: 2px solid #4ade80;
        color: #065f46;
        padding: 14px 16px;
        border-radius: 12px;
        margin-bottom: 24px;
        font-size: 14px;
        font-weight: 500;
    }

    @media (max-width: 640px) {
        .profile-top {
            flex-direction: column;
            text-align: center;
        }

        .form-row {
            grid-template-columns: 1fr;
        }

        .btn-group {
            flex-direction: column;
        }
    }
</style>
<x-app-layout>
    <div class="container pt-20">
        <div class="profile-header">
            <div class="profile-top">
                <div class="avatar">{{ ucfirst($user->first_name[0]) }}</div>
                <div class="profile-info">
                    <h1>{{ $user->first_name ?? 'John' }} {{ $user->last_name ?? 'Doe' }}</h1>
                    <p>Member since {{ date_format($user->created_at, 'Y') ?? '' }}</p>
                </div>
            </div>
        </div>

        <div class="profile-actions bg-white rounded-2xl shadow-lg p-6 mb-6">

            <h3 class="text-lg font-semibold text-gray-800 mb-4">Share Your Profile</h3>

            <div class="flex flex-col sm:flex-row gap-4">

                <!-- Generate QR Code Button -->

                <button id="generateQrBtn" 

                        class="flex-1 flex items-center justify-center gap-2 bg-gradient-to-r from-green-400 to-blue-500 text-white py-3 px-6 rounded-xl font-semibold hover:shadow-lg transition duration-200">

                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 

                            d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />

                    </svg>

                    Generate QR Code

                </button>

                <!-- Generate Link Button -->

                <button id="generateLinkBtn"

                        class="flex-1 flex items-center justify-center gap-2 bg-gradient-to-r from-green-400 to-blue-500 text-white py-3 px-6 rounded-xl font-semibold hover:shadow-lg transition duration-200">

                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 

                            d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />

                    </svg>

                    Generate Friend Link

                </button>

            </div>

        </div>

        <!-- QR Code Modal -->

        <div id="qrModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">

            <div class="bg-white rounded-2xl p-8 max-w-sm w-full mx-4">

                <div class="flex justify-between items-center mb-4">

                    <h3 class="text-xl font-bold text-gray-800">Your QR Code</h3>

                    <button id="closeQrModal" class="text-gray-500 hover:text-gray-700">

                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />

                        </svg>

                    </button>

                </div>

                <div id="qrCodeContainer" class="flex justify-center mb-4">

                    <!-- QR Code will be inserted here -->

                </div>

                <p class="text-sm text-gray-500 text-center">

                    Valid for <span class="font-semibold">1 hour</span>. Anyone who scans this will become your friend.

                </p>

            </div>

        </div>

        <!-- Link Modal -->

        <div id="linkModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">

            <div class="bg-white rounded-2xl p-8 max-w-md w-full mx-4">

                <div class="flex justify-between items-center mb-4">

                    <h3 class="text-xl font-bold text-gray-800">Your Friend Link</h3>

                    <button id="closeLinkModal" class="text-gray-500 hover:text-gray-700">

                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />

                        </svg>

                    </button>

                </div>

                <div class="mb-4">

                    <input type="text" id="friendLinkInput" readonly

                        class="w-full px-4 py-3 bg-gray-100 border border-gray-200 rounded-xl text-sm">

                </div>

                <button id="copyLinkBtn" 

                        class="w-full bg-gradient-to-r from-green-400 to-blue-500 text-white py-3 rounded-xl font-semibold hover:shadow-lg transition">

                    Copy to Clipboard

                </button>

                <p class="text-sm text-gray-500 text-center mt-4">

                    Valid for <span class="font-semibold">1 hour</span>. Anyone who opens this link will become your friend.

                </p>

            </div>

        </div>
        <div class="profile-form">
            @if (session('success'))
                <div class="success-message">
                    {{ session('success') }}
                </div>
            @endif

            <h2 class="section-title">Profile Information</h2>

            <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                @csrf
                @method('patch')

                <div class="form-row">
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" id="first_name" name="first_name"
                            value="{{ old('first_name', $user->first_name ?? 'John') }}" required>
                        @error('first_name')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" id="last_name" name="last_name"
                            value="{{ old('last_name', $user->last_name ?? 'Doe') }}" required>
                        @error('last_name')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email"
                        value="{{ old('email', $user->email ?? 'john.doe@example.com') }}" required>
                    @error('email')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="bio">Bio</label>
                    <textarea id="bio" name="bio" placeholder="Tell us about yourself..."
                        class="w-full px-4 py-[14px] border-2 border-[#e2e8f0] rounded-[12px] text-[15px] text-[#1e293b] bg-[#f8fafc] transition-all duration-300 ease-in-out font-inherit focus:outline-none focus:border-[#4ade80] focus:bg-white focus:ring-4 focus:ring-[#4ade80]/10">{{ old('bio', $user->bio ?? '') }}</textarea>
                    <p class="helper-text">Write a short bio about yourself</p>
                    @error('bio')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="btn-group px-10 md:px-40">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
                @if (session('status') === 'profile-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-center text-gray-600">{{ __('Saved') }}</p>
                @endif


            </form>

            <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                @csrf
                @method('put')


                <h2 class="section-title" style="margin-top: 40px;">Change Password</h2>

                <div class="form-group">
                    <label for="current_password">Current Password</label>
                    <div class="password-field">
                        <input type="password" id="current_password" name="current_password" placeholder="••••••••">
                        <button type="button" class="password"
                            onclick="togglePassword('current_password')">Show</button>
                    </div>
                    @error('current_password')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="password">New Password</label>
                        <div class="password-field">
                            <input type="password" id="password" name="password" placeholder="••••••••">
                            <button type="button" class="password" onclick="togglePassword('password')">Show</button>
                        </div>
                        @error('password')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirm New Password</label>
                        <div class="password-field">
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                placeholder="••••••••">
                            <button type="button" class="password"
                                onclick="togglePassword('password_confirmation')">Show</button>
                        </div>
                    </div>
                </div>

                <div class="btn-group px-10 md:px-40">
                    <button type="submit" class="btn btn-primary">Save New Password</button>
                </div>
                @if (session('status') === 'password-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-center text-gray-600">{{ __('Saved') }}</p>
                @endif
            </form>

            <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                
                <h2 class="section-title" style="margin-top: 40px;">Change Password</h2>
                <label for="remove_message">remove message after 30 day</label>
                <input type="checkbox" name="remove_message" id="remove_message">                
                
            </form>

        </div>
    </div>

    @push('scripts')
        <script>
            // By attaching to 'window', we fix the "not defined" error
            window.togglePassword = function(fieldId) {
                const input = document.getElementById(fieldId);
                const button = input.nextElementSibling;

                if (input.type === 'password') {
                    input.type = 'text';
                    button.textContent = 'Hide';
                } else {
                    input.type = 'password';
                    button.textContent = 'Show';
                }
            }

        document.getElementById('generateQrBtn').addEventListener('click', async function() {

                const modal = document.getElementById('qrModal');

                const container = document.getElementById('qrCodeContainer');

                container.innerHTML = '<div class="animate-pulse bg-gray-200 w-72 h-72 rounded-lg"></div>';

                modal.classList.remove('hidden');

                try {

                    const response = await fetch('{{ route("qr.generate") }}');

                    const svg = await response.text();

                    container.innerHTML = svg;

                } catch (error) {

                    container.innerHTML = '<p class="text-red-500">Failed to generate QR code</p>';

                }

            });

            // Close QR Modal

            document.getElementById('closeQrModal').addEventListener('click', function() {

                document.getElementById('qrModal').classList.add('hidden');

            });

            // Generate Link

            document.getElementById('generateLinkBtn').addEventListener('click', async function() {

                const modal = document.getElementById('linkModal');

                const input = document.getElementById('friendLinkInput');

                modal.classList.remove('hidden');

                input.value = 'Generating...';

                try {

                    const response = await fetch('{{ route("qr.generate-link") }}', {

                        method: 'POST',

                        headers: {

                            'X-CSRF-TOKEN': '{{ csrf_token() }}',

                            'Accept': 'application/json',

                        }

                    });

                    const data = await response.json();

                    input.value = data.url;

                } catch (error) {

                    input.value = 'Failed to generate link';

                }

            });

            // Close Link Modal

            document.getElementById('closeLinkModal').addEventListener('click', function() {

                document.getElementById('linkModal').classList.add('hidden');

            });

            // Copy Link

            document.getElementById('copyLinkBtn').addEventListener('click', function() {

                const input = document.getElementById('friendLinkInput');

                navigator.clipboard.writeText(input.value);

                this.textContent = 'Copied!';

                setTimeout(() => this.textContent = 'Copy to Clipboard', 2000);

            });

            // Close modals on outside click

            document.getElementById('qrModal').addEventListener('click', function(e) {

                if (e.target === this) this.classList.add('hidden');

            });

            document.getElementById('linkModal').addEventListener('click', function(e) {

                if (e.target === this) this.classList.add('hidden');

            });
        </script>
    @endpush
</x-app-layout>
