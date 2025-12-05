<script setup lang="ts">
import { usePage } from "@inertiajs/vue3";
import { Menu, X } from "lucide-vue-next";
import { computed, ref, onMounted, onBeforeUnmount } from "vue";

// Auth user
const page = usePage();
const user = computed(() => page.props.auth?.user);
const avatar = computed(() => user.value?.name?.[0]?.toUpperCase() || "U");

// State
const isOpen = ref(false);       // mobile menu
const isAvatarOpen = ref(false); // avatar dropdown

// Refs
const menuDropdown = ref<HTMLElement | null>(null);
const menuButton = ref<HTMLElement | null>(null);
const avatarDropdown = ref<HTMLElement | null>(null);
const avatarButton = ref<HTMLElement | null>(null);

// Toggle functions
const toggleMenu = () => {
  isOpen.value = !isOpen.value;
};
const toggleAvatar = () => {
  isAvatarOpen.value = !isAvatarOpen.value;
};

// Click-away handler
const handleClickOutside = (event) => {
  const target = event.target;

  // Mobile menu
  if (
    isOpen.value &&
    menuDropdown.value &&
    menuButton.value &&
    !menuDropdown.value.contains(target) &&
    !menuButton.value.contains(target)
  ) {
    isOpen.value = false;
  }

  // Avatar dropdown
  if (
    isAvatarOpen.value &&
    avatarDropdown.value &&
    avatarButton.value &&
    !avatarDropdown.value.contains(target) &&
    !avatarButton.value.contains(target)
  ) {
    isAvatarOpen.value = false;
  }
};

onMounted(() => document.addEventListener("click", handleClickOutside));
onBeforeUnmount(() => document.removeEventListener("click", handleClickOutside));
</script>

<template>
  <header class="px-6 py-4 bg-white shadow">
    <div class="flex items-center justify-between mx-auto max-w-7xl">
      
      <Link :href="route('home')">
        <h1 class="text-2xl font-bold text-black">Noting</h1>
      </Link>

      <!-- Mobile menu button -->
      <button
        ref="menuButton"
        @click.stop="toggleMenu" 
        aria-controls="mobile-menu"
        :aria-expanded="isOpen"
        class="lg:hidden"
      >
        <Menu v-if="!isOpen" class="cursor-pointer outline-none" />
        <X v-if="isOpen" class="cursor-pointer outline-none" />
      </button>

      <!-- Desktop nav + avatar -->
      <nav class="hidden lg:flex items-center gap-4 relative">
        <ul class="flex items-center gap-4">
          <li class="font-bold text-md text-black hover:text-blue-900 cursor-pointer">
            <Link :href="route('create-note')">Notes</Link>
          </li>
          <li class="font-bold text-md text-black hover:text-blue-900 cursor-pointer">
            <Link :href="route('category.index')">Categories</Link>
          </li>
        </ul>

        <!-- Avatar dropdown -->
        <div class="relative">
          <button
            ref="avatarButton"
            @click.stop="toggleAvatar" 
            class="bg-gray-300 w-8 h-8 flex items-center justify-center rounded-full cursor-pointer"
          >
            {{ avatar }}
          </button>

          <div
            ref="avatarDropdown"
            v-show="isAvatarOpen"
            class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-md py-2 z-50 border border-gray-300"
          >
            <Link :href="route('profile')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</Link>
            <Link class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</Link>
            <Link :href="route('logout')" method="POST" class="block px-4 py-2 text-sm text-red-500 hover:bg-red-50 w-full text-left">Logout</Link>
          </div>
        </div>
      </nav>
    </div>

    <!-- Mobile menu -->
    <div
      ref="menuDropdown"
      v-show="isOpen"
      class="lg:hidden px-2 pt-2 pb-3 space-y-1 sm:px-3 border-t border-gray-200 mt-4"
    >
      <ul class="flex flex-col gap-4">
        <li class="font-bold text-md text-black">
          <Link :href="route('create-note')">Notes</Link>
        </li>
        <li class="font-bold text-md text-black">
          <Link :href="route('category.index')">Categories</Link>
        </li>
        <li class="font-bold text-md text-black">
          <Link :href="route('profile')">Profile</Link>
        </li>
        <li class="font-bold text-md text-black">
          <Link :href="route('logout')" method="post">Logout</Link>
        </li>
      </ul>
    </div>
  </header>

  <main class="flex-1 container mx-auto max-w-7xl my-8 p-4">
    <slot />
  </main>
</template>
