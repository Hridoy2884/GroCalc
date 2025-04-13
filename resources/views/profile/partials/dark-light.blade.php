<div x-data="{ darkMode: localStorage.getItem('theme') === 'dark' }"
     x-init="$watch('darkMode', val => {
        localStorage.setItem('theme', val ? 'dark' : 'light');
        document.documentElement.classList.toggle('dark', val);
     })"
     class="text-right px-4 py-2 bg-gray-100 dark:bg-gray-800">
    <button @click="darkMode = !darkMode"
            class="text-sm px-3 py-1 border rounded dark:border-gray-600 dark:text-white">
        <span x-text="darkMode ? '☀ Light Mode' : '🌙 Dark Mode'"></span>
    </button>
</div>
