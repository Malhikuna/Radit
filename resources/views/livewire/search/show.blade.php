<div class="w-full max-w-5xl mx-auto px-4 py-4">

    <!-- FILTER TABS -->
    <div class="flex items-center gap-3 mb-6">
        <button id="btn-all" class="px-4 py-2 rounded-full text-sm font-semibold bg-blue-100 text-blue-700">
            All
        </button>

        <button id="btn-posts"
            class="px-4 py-2 rounded-full text-sm font-medium bg-gray-100 hover:bg-gray-200 text-gray-700">
            Posts
        </button>

        <button id="btn-communities"
            class="px-4 py-2 rounded-full text-sm font-medium bg-gray-100 hover:bg-gray-200 text-gray-700">
            Communities
        </button>

        <button id="btn-people"
            class="px-4 py-2 rounded-full text-sm font-medium bg-gray-100 hover:bg-gray-200 text-gray-700">
            People
        </button>
    </div>

    <!-- ================= ALL ================= -->
    <div id="content-all" class="space-y-5">
         <div class="flex justify-between items-center">
            <h2 class="text-lg font-semibold">Communities</h2>
            <button id="see-more-all" class="text-sm text-blue-600 hover:underline">See more</button>
        </div>

        <div class="space-y-4">
            <div class="space-y-4">
                <div class="flex items-center gap-4 border-b pb-4">
                    <div class="w-10 h-10 bg-gray-200 rounded-full"></div>
                    <div>
                        <h3 class="font-semibold">r/batman</h3>
                        <p class="text-sm text-gray-500">The Dark Knight</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 border-b pb-4 hidden extra-communities">
                    <div class="w-10 h-10 bg-gray-200 rounded-full"></div>
                    <div>
                        <h3 class="font-semibold">r/comics</h3>
                        <p class="text-sm text-gray-500">Comic discussions</p>
                    </div>
                </div>
            </div>
        </div>
        {{-- Post (ALL) --}}
        <div class="flex justify-between items-center">
            <h2 class="text-lg font-semibold">Posts</h2>
            <button id="see-more-all" class="text-sm text-blue-600 hover:underline">See more</button>
        </div>

        <div class="space-y-4">
            <div class="border rounded-xl p-4">
                <h3 class="font-semibold">Can Batman be real?</h3>
                <p class="text-sm text-gray-500">r/batman • 1 hour ago</p>
            </div>

            <div class="border rounded-xl p-4">
                <h3 class="font-semibold">I hope DCU Batman moves like this!</h3>
                <p class="text-sm text-gray-500">r/DCU • 2 hours ago</p>
            </div>

            <div class="border rounded-xl p-4 hidden extra-all">
                <h3 class="font-semibold">Best Batman comic?</h3>
                <p class="text-sm text-gray-500">r/comics • 3 hours ago</p>
            </div>

            <div class="border rounded-xl p-4 hidden extra-all">
                <h3 class="font-semibold">Live-action Batman ranking</h3>
                <p class="text-sm text-gray-500">r/movies • 4 hours ago</p>
            </div>
        </div>
    </div>

    <!-- ================= POSTS ================= -->
    <div id="content-posts" class="hidden space-y-5">

        <div class="space-y-4">
            <div class="border rounded-xl p-4">
                <h3 class="font-semibold">Why Batman works without powers</h3>
                <p class="text-sm text-gray-500">r/superheroes</p>
            </div>

            <div class="border rounded-xl p-4 hidden extra-posts">
                <h3 class="font-semibold">Best Gotham depiction</h3>
                <p class="text-sm text-gray-500">r/films</p>
            </div>
        </div>
    </div>

    <!-- ================= COMMUNITIES ================= -->
    <div id="content-communities" class="hidden space-y-5">

        <div class="space-y-4">
            <div class="flex items-center gap-4 border-b pb-4">
                <div class="w-10 h-10 bg-gray-200 rounded-full"></div>
                <div>
                    <h3 class="font-semibold">r/batman</h3>
                    <p class="text-sm text-gray-500">The Dark Knight</p>
                </div>
            </div>

            <div class="flex items-center gap-4 border-b pb-4 hidden extra-communities">
                <div class="w-10 h-10 bg-gray-200 rounded-full"></div>
                <div>
                    <h3 class="font-semibold">r/comics</h3>
                    <p class="text-sm text-gray-500">Comic discussions</p>
                </div>
            </div>
        </div>
    </div>

    <!-- ================= PEOPLE ================= -->
    <div id="content-people" class="hidden space-y-5">

        <div class="space-y-4">
            <div class="flex items-center gap-4 border-b pb-4">
                <div class="w-10 h-10 bg-gray-300 rounded-full"></div>
                <div>
                    <h3 class="font-semibold">Bruce Wayne</h3>
                    <p class="text-sm text-gray-500">u/brucewayne • Gotham</p>
                </div>
            </div>

            <div class="flex items-center gap-4 border-b pb-4 hidden extra-people">
                <div class="w-10 h-10 bg-gray-300 rounded-full"></div>
                <div>
                    <h3 class="font-semibold">Diana Prince</h3>
                    <p class="text-sm text-gray-500">u/wonderwoman • Themyscira</p>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', () => {

    const contents = {
        all: document.getElementById('content-all'),
        posts: document.getElementById('content-posts'),
        communities: document.getElementById('content-communities'),
        people: document.getElementById('content-people')
    };

    const buttons = {
        all: document.getElementById('btn-all'),
        posts: document.getElementById('btn-posts'),
        communities: document.getElementById('btn-communities'),
        people: document.getElementById('btn-people')
    };

    function switchTab(tab) {
        Object.values(contents).forEach(c => c.classList.add('hidden'));
        Object.values(buttons).forEach(b => {
            b.classList.remove('bg-blue-100', 'text-blue-700', 'font-semibold');
            b.classList.add('bg-gray-100', 'text-gray-700');
        });

        contents[tab].classList.remove('hidden');
        buttons[tab].classList.add('bg-blue-100', 'text-blue-700', 'font-semibold');
    }

    buttons.all.onclick = () => switchTab('all');
    buttons.posts.onclick = () => switchTab('posts');
    buttons.communities.onclick = () => switchTab('communities');
    buttons.people.onclick = () => switchTab('people');

    document.getElementById('see-more-all').onclick = () =>
        document.querySelectorAll('.extra-all').forEach(e => e.classList.remove('hidden'));

    document.getElementById('see-more-posts').onclick = () =>
        document.querySelectorAll('.extra-posts').forEach(e => e.classList.remove('hidden'));

    document.getElementById('see-more-communities').onclick = () =>
        document.querySelectorAll('.extra-communities').forEach(e => e.classList.remove('hidden'));

    document.getElementById('see-more-people').onclick = () =>
        document.querySelectorAll('.extra-people').forEach(e => e.classList.remove('hidden'));

});
</script>
