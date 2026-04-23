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

<style scoped>
.sptechbd-app {
    display: flex;
    min-height: 100vh;
    background: linear-gradient(135deg, #fdf4ff 0%, #fce7f3 50%, #ede9fe 100%);
    font-family: 'Inter', 'Segoe UI', sans-serif;
}

/* ─── Sidebar ─── */
.sptechbd-sidebar {
    width: 240px;
    min-height: 100vh;
    background: linear-gradient(180deg, #ffffff 0%, #fdf4ff 100%);
    border-right: 1px solid #f3e8ff;
    display: flex;
    flex-direction: column;
    position: fixed;
    top: 0;
    left: 0;
    z-index: 50;
    transition: transform 0.3s ease;
    box-shadow: 2px 0 20px rgba(168, 85, 247, 0.06);
}

.sidebar-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.3);
    z-index: 40;
    backdrop-filter: blur(2px);
}

.sidebar-logo {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 20px 20px 16px;
    border-bottom: 1px solid #f3e8ff;
}

.logo-circle-sm {
    width: 36px;
    height: 36px;
    background: linear-gradient(135deg, #a855f7, #ec4899);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 800;
    font-size: 14px;
    flex-shrink: 0;
    box-shadow: 0 4px 12px rgba(168, 85, 247, 0.2);
}

.logo-name-gradient {
    font-size: 18px;
    font-weight: 800;
    background: linear-gradient(135deg, #7c3aed, #db2777);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    line-height: 1.1;
}

.logo-tagline {
    font-size: 8px;
    font-weight: 700;
    color: #9ca3af;
    letter-spacing: 1px;
    margin-top: 1px;
}

.nav-label {
    font-size: 10px;
    font-weight: 700;
    color: #9ca3af;
    letter-spacing: 1.5px;
    padding: 20px 20px 8px;
}

.sidebar-nav {
    display: flex;
    flex-direction: column;
    gap: 2px;
    padding: 0 12px;
    flex: 1;
}

.nav-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 12px;
    border-radius: 10px;
    color: #6b7280;
    font-size: 14px;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.2s ease;
}

.nav-item:hover {
    background: #f5f3ff;
    color: #7c3aed;
}

.nav-item-active {
    background: linear-gradient(135deg, #a855f7, #ec4899) !important;
    color: white !important;
    font-weight: 600;
    box-shadow: 0 4px 12px rgba(168, 85, 247, 0.3);
}

.nav-icon {
    display: flex;
    align-items: center;
    flex-shrink: 0;
}

.sidebar-bottom {
    padding: 20px 16px;
}

.sidebar-cta {
    background: linear-gradient(135deg, #a855f7, #ec4899);
    border-radius: 14px;
    padding: 16px;
    color: white;
}

.cta-title {
    font-size: 14px;
    font-weight: 700;
    margin-bottom: 4px;
}

.cta-sub {
    font-size: 12px;
    opacity: 0.85;
}

/* ─── Main ─── */
.sptechbd-main {
    flex: 1;
    margin-left: 240px;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

/* ─── Header ─── */
.sptechbd-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 16px 28px;
    background: rgba(255,255,255,0.7);
    backdrop-filter: blur(12px);
    border-bottom: 1px solid rgba(243, 232, 255, 0.8);
    position: sticky;
    top: 0;
    z-index: 30;
}

.header-left {
    display: flex;
    align-items: center;
    gap: 12px;
}

.hamburger {
    display: none;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    border: none;
    background: transparent;
    color: #6b7280;
    border-radius: 8px;
    cursor: pointer;
    transition: background 0.2s;
}

.hamburger:hover {
    background: #f3e8ff;
}

.page-title {
    font-size: 20px;
    font-weight: 800;
    color: #1e1b4b;
    line-height: 1.2;
    margin: 0;
}

.page-subtitle {
    font-size: 11px;
    color: #9ca3af;
    margin: 1px 0 0;
    font-weight: 500;
}

@media (min-width: 768px) {
    .page-title { font-size: 26px; }
    .page-subtitle { font-size: 13px; }
}

.event-mode-btn {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    background: linear-gradient(135deg, #a855f7, #ec4899);
    color: white;
    border-radius: 12px;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.2s ease;
    box-shadow: 0 4px 12px rgba(168, 85, 247, 0.3);
}

.event-mode-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 6px 16px rgba(168, 85, 247, 0.4);
}

/* ─── Content ─── */
.sptechbd-content {
    flex: 1;
    padding: 24px 28px;
}

/* ─── Footer ─── */
.sptechbd-footer {
    text-align: center;
    padding: 20px;
    font-size: 12px;
    color: #9ca3af;
    border-top: 1px solid rgba(243, 232, 255, 0.6);
}

.footer-link {
    color: #a855f7;
    font-weight: 600;
    text-decoration: none;
    transition: color 0.2s;
}

.footer-link:hover {
    color: #ec4899;
    text-decoration: underline;
}

/* ─── Mobile ─── */
@media (max-width: 768px) {
    .sptechbd-sidebar {
        transform: translateX(-100%);
    }

    .sidebar-open {
        transform: translateX(0);
    }

    .sptechbd-main {
        margin-left: 0;
    }

    .hamburger {
        display: flex;
    }

    .sptechbd-content {
        padding: 12px;
    }

    .sptechbd-header {
        padding: 12px 16px;
    }

    .event-mode-btn {
        padding: 8px 12px;
        font-size: 12px;
        border-radius: 10px;
    }
}
</style>
