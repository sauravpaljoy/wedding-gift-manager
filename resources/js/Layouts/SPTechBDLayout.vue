<script setup>
import { ref, computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';

const page = usePage();
const user = computed(() => page.props.auth.user);
const sidebarOpen = ref(false);

const navItems = [
    { name: 'Dashboard', route: 'dashboard', icon: `<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>` },
    { name: 'Guests', route: 'guests.index', icon: `<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>` },
    { name: 'Add Entry', route: 'gifts.create', icon: `<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>` },
    { name: 'Reports', route: 'reports.index', icon: `<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>` },
    { name: 'Reminders', route: 'reminders.index', icon: `<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>` },
    { name: 'Settings', route: 'settings.index', icon: `<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.07 4.93a10 10 0 0 0-14.14 0M4.93 19.07a10 10 0 0 0 14.14 0M4.93 4.93l14.14 14.14M4.93 4.93A10 10 0 0 0 2 12m20 0a10 10 0 0 0-2.93-7.07"/></svg>` },
];

function isActive(routeName) {
    try {
        return route().current(routeName);
    } catch (e) {
        return false;
    }
}
</script>

<template>
    <div class="sptechbd-app">
        <!-- Mobile Overlay -->
        <div
            v-if="sidebarOpen"
            class="sidebar-overlay"
            @click="sidebarOpen = false"
        ></div>

        <!-- Sidebar -->
        <aside :class="['sptechbd-sidebar', { 'sidebar-open': sidebarOpen }]">
            <!-- Logo -->
            <div class="sidebar-logo">
                <div class="logo-circle-sm">
                    <span>SP</span>
                </div>
                <div class="logo-text">
                    <div class="logo-name-gradient">Tech BD</div>
                    <div class="logo-tagline">WEDDING MANAGER</div>
                </div>
            </div>

            <!-- Nav Label -->
            <div class="nav-label">MENU</div>

            <!-- Navigation -->
            <nav class="sidebar-nav">
                <Link
                    v-for="item in navItems"
                    :key="item.name"
                    :href="route(item.route)"
                    :class="['nav-item', { 'nav-item-active': isActive(item.route) }]"
                    @click="sidebarOpen = false"
                >
                    <span class="nav-icon" v-html="item.icon"></span>
                    <span>{{ item.name }}</span>
                </Link>
            </nav>

            <!-- Bottom CTA -->
            <div class="sidebar-bottom">
                <div class="sidebar-cta">
                    <div class="cta-title">{{ user?.name }}</div>
                    <div class="cta-sub">{{ user?.wedding_name || 'Wedding / Event Name' }}</div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="sptechbd-main">
            <!-- Top Header -->
            <header class="sptechbd-header">
                <div class="header-left">
                    <button class="hamburger" @click="sidebarOpen = !sidebarOpen">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="3" y1="12" x2="21" y2="12"/>
                            <line x1="3" y1="6" x2="21" y2="6"/>
                            <line x1="3" y1="18" x2="21" y2="18"/>
                        </svg>
                    </button>
                    <div>
                        <h1 class="page-title">
                            <slot name="title">Dashboard</slot>
                        </h1>
                        <p class="page-subtitle">
                            <slot name="subtitle">Track every guest, gift and blessing 🌸</slot>
                        </p>
                    </div>
                </div>
                <div class="header-right">
                    <Link :href="route('gifts.create')" class="event-mode-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                        Event Mode
                    </Link>
                </div>
            </header>

            <!-- Page Content -->
            <main class="sptechbd-content">
                <slot />
            </main>

            <!-- Footer -->
            <footer class="sptechbd-footer">
                &copy; SP Tech BD 2026. All Rights Reserved. Developed by <a href="https://sauravpal.xyz/" target="_blank" class="footer-link">Saurav pal</a>
            </footer>
        </div>
    </div>
</template>

</template>
