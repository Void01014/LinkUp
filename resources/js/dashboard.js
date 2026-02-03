import swal from 'sweetalert2';

const searchBtn = document.querySelector('#searchBtn')

searchBtn.addEventListener('click', async () => {

    const username_field = document.querySelector('[name="username"]');
    console.log(username_field);

    const username_value = username_field.value.trim();

    try {
        swal.fire({
            title: 'Searching Users...',
            allowOutsideClick: false,
            didOpen: () => {
                swal.showLoading();
            }
        });

        const response = await fetch(`/search?username=${username_value}`, {
            method: 'GET',
            headers: {
                'Content-type': 'application/json',
            }
        });

        const result = await response.json();

        swal.close();

        const users_grid = document.querySelector('#users_grid');
        let users_cards = [];

        result.forEach(user => {
            users_cards.push(`<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg transition">
                        <div class="p-6">
                            <!-- User Avatar & Name -->
                            <div class="flex flex-col items-center text-center mb-4">
                                <div
                                    class="w-24 h-24 rounded-full bg-gradient-to-br from-green-400 to-blue-500 flex items-center justify-center text-white font-bold text-2xl mb-3">
                                    ${user.first_name[0].toUpperCase()}
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900">${user.first_name} ${user.last_name}</h3>
                            </div>

                            <!-- User Bio -->
                            <p class="text-sm text-gray-600 text-center mb-4 line-clamp-2">
                                ${user.bio}
                            </p>

                            <!-- User Stats -->
                            <div class="flex justify-around border-t border-b border-gray-200 py-3 mb-4">
                                <div class="text-center">
                                    <p class="text-lg font-semibold text-gray-900">{{ $user['friends_count'] }}</p>
                                    <p class="text-xs text-gray-500">Friends</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-lg font-semibold text-gray-900">
                                        {{ date_format($user['created_at'], 'M Y') }}</p>
                                    <p class="text-xs text-gray-500">Joined</p>
                                </div>
                            </div>
                            <!-- Friend Request Button -->
                            @if ($user['status'] == 'null')
                                <button
                                    class="w-full bg-gradient-to-r from-green-400 to-blue-500 text-white py-2 rounded-lg font-medium hover:shadow-lg transition">
                                    Add Friend
                                </button>
                            @elseif($user['status'] == 'pending')
                                <button
                                    class="w-full bg-gray-300 text-gray-600 py-2 rounded-lg font-medium cursor-not-allowed"
                                    disabled>
                                    Request Pending
                                </button>
                            @elseif($user['status'] == 'accepted')
                                <div class="flex gap-2">
                                    <button
                                        class="flex-1 bg-red-500 text-white py-2 rounded-lg font-medium hover:bg-red-600 transition">
                                        Unfriend
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
`);
                const users = users_cards.join('');

                users_grid.innerHTML = users;
        });

    } catch (err) {
        console.error('Error editing profile:', err);
        swal.fire({
            icon: 'error',
            title: 'System Error',
            text: 'Could not reach the server.',
            confirmButtonColor: '#ef4444'
        });
    }
});
