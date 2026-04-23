<template>
    <div class="flex items-center gap-2">
        <div class="logo-circle">
            <span>SP</span>
        </div>
        <span class="logo-text-gradient">Tech BD</span>
    </div>
</template>

<style scoped>
.logo-circle {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 48px;
    height: 48px;
    background: linear-gradient(135deg, #a855f7, #ec4899);
    border-radius: 50%;
    color: white;
    font-weight: 800;
    font-size: 18px;
    flex-shrink: 0;
}

.logo-text-gradient {
    font-weight: 900;
    font-size: 36px;
    background: linear-gradient(135deg, #7c3aed, #db2777);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    letter-spacing: -1.5px;
}
</style>
