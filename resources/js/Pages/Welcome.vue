<script setup>
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
  <Head title="Welcome - Wedding Gift Manager" />
  
  <div class="min-h-screen bg-[#faf9fe] font-sans text-gray-900 selection:bg-purple-100 selection:text-purple-900">
    <!-- 🌈 NAVBAR -->
    <header class="fixed top-0 left-0 right-0 z-50 flex justify-between items-center px-6 md:px-12 py-5 bg-white/70 backdrop-blur-md border-b border-purple-50">
      <div class="flex items-center gap-2">
        <div class="w-10 h-10 bg-gradient-to-tr from-purple-600 to-pink-500 rounded-xl flex items-center justify-center shadow-lg shadow-purple-200">
            <span class="text-white font-bold text-xl">W</span>
        </div>
        <h1 class="text-2xl font-black bg-clip-text text-transparent bg-gradient-to-r from-purple-600 to-pink-600 tracking-tight">
            WeddingGift
        </h1>
      </div>

      <div class="flex items-center space-x-6">
        <Link :href="route('login')" class="hidden md:block text-sm font-semibold text-gray-600 hover:text-purple-600 transition-colors">
            Login
        </Link>
        <Link :href="route('register')" class="px-6 py-2.5 bg-purple-600 text-white text-sm font-bold rounded-full shadow-lg shadow-purple-200 hover:bg-purple-700 hover:shadow-purple-300 transition-all active:scale-95">
          Get Started
        </Link>
      </div>
    </header>

    <!-- 🚀 HERO -->
    <section class="relative pt-32 pb-20 md:pt-48 md:pb-32 overflow-hidden">
        <!-- Background decorative elements -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full -z-10">
            <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-purple-200/50 blur-[120px] rounded-full animate-pulse"></div>
            <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-pink-200/50 blur-[120px] rounded-full animate-pulse" style="animation-delay: 2s"></div>
        </div>

        <div class="max-w-7xl mx-auto px-6 text-center">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-purple-50 border border-purple-100 text-purple-600 text-xs font-bold mb-8 animate-bounce-slow">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-purple-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-purple-500"></span>
                </span>
                The #1 Wedding Gift Tracker in BD 🇧🇩
            </div>

            <h1 class="text-5xl md:text-7xl font-black mb-8 leading-[1.1] tracking-tight text-gray-900">
                Track Every Gift <br />
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-purple-600 via-pink-500 to-orange-400">
                    Beautifully & Effortlessly 💜
                </span>
            </h1>

            <p class="text-lg md:text-xl mb-10 max-w-2xl mx-auto text-gray-600 leading-relaxed">
                অতিথি, ক্যাশ এবং গিফট—সবকিছু এক জায়গায় ম্যানেজ করুন। আর কখনো ভুলবেন না কে কি দিল। আপনার স্পেশাল দিনটির হিসাব হোক সহজ ও ডিজিটাল।
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <Link :href="route('register')"
                   class="w-full sm:w-auto px-10 py-4 bg-purple-600 text-white rounded-2xl font-bold text-lg shadow-xl shadow-purple-200 hover:bg-purple-700 hover:shadow-purple-300 transition-all hover:-translate-y-1">
                  Get Started Free
                </Link>

                <a href="#demo"
                   class="w-full sm:w-auto px-10 py-4 bg-white border-2 border-purple-100 text-purple-600 rounded-2xl font-bold text-lg hover:bg-purple-50 transition-all">
                  Live Demo
                </a>
            </div>
            
            <!-- Dashboard Mockup Placeholder -->
            <div class="mt-20 relative group">
                <div class="absolute inset-0 bg-gradient-to-t from-[#faf9fe] via-transparent to-transparent z-10"></div>
                <div class="absolute -inset-4 bg-gradient-to-r from-purple-500 to-pink-500 rounded-[2.5rem] blur-2xl opacity-20 group-hover:opacity-30 transition-opacity"></div>
                <img src="/images/dashboard.png" alt="Dashboard Preview" 
                     class="relative z-0 rounded-2xl md:rounded-[2rem] shadow-2xl border border-white/50 w-full max-w-5xl mx-auto transform group-hover:scale-[1.01] transition-transform duration-500" />
            </div>
        </div>
    </section>

    <!-- 😓 PROBLEM SECTION -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-5xl font-black mb-4">Wedding Gift Tracking is Messy 😓</h2>
                <p class="text-gray-500 font-medium">Why manual tracking fails you</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="group p-8 bg-purple-50/50 rounded-3xl border border-transparent hover:border-purple-100 hover:bg-white hover:shadow-xl transition-all duration-300">
                    <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center text-3xl shadow-sm mb-6 group-hover:scale-110 transition-transform">
                        🧠
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gray-900">ভুলে যাওয়ার ভয়</h3>
                    <p class="text-gray-600">কে কত টাকা বা কি গিফট দিল তা মনে রাখা অসম্ভব।</p>
                </div>

                <div class="group p-8 bg-pink-50/50 rounded-3xl border border-transparent hover:border-pink-100 hover:bg-white hover:shadow-xl transition-all duration-300">
                    <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center text-3xl shadow-sm mb-6 group-hover:scale-110 transition-transform">
                        📄
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gray-900">খাতা হারিয়ে যাওয়া</h3>
                    <p class="text-gray-600">হাতের লিখা বা কাগজের নোট যেকোনো সময় হারিয়ে যেতে পারে।</p>
                </div>

                <div class="group p-8 bg-orange-50/50 rounded-3xl border border-transparent hover:border-orange-100 hover:bg-white hover:shadow-xl transition-all duration-300">
                    <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center text-3xl shadow-sm mb-6 group-hover:scale-110 transition-transform">
                        🧮
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gray-900">হিসাব মিলানো ঝামেলা</h3>
                    <p class="text-gray-600">ম্যানুয়ালি হাজারো মানুষের গিফটের হিসাব মিলানো অনেক সময়ের কাজ।</p>
                </div>
            </div>

            <div class="mt-16 text-center">
                <div class="inline-flex items-center gap-3 px-6 py-3 bg-green-50 text-green-700 rounded-full font-bold text-lg border border-green-100">
                    <span class="flex h-3 w-3 rounded-full bg-green-500"></span>
                    এখন সব ডিজিটালভাবে সহজভাবে ম্যানেজ করুন
                </div>
            </div>
        </div>
    </section>

    <!-- 🎁 FEATURES -->
    <section class="py-24 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-96 h-96 bg-purple-100/50 blur-[100px] rounded-full -z-10"></div>
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-6">
                <div class="max-w-2xl">
                    <h2 class="text-4xl md:text-5xl font-black mb-6">Powerful Features for Your Big Day</h2>
                    <p class="text-lg text-gray-600 font-medium leading-relaxed">
                        We've built everything you need to keep your wedding gifts organized and accessible from anywhere.
                    </p>
                </div>
                <Link :href="route('register')" class="text-purple-600 font-bold hover:underline">Explore all features &rarr;</Link>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="p-10 bg-white rounded-[2.5rem] shadow-sm border border-gray-100 hover:shadow-2xl hover:shadow-purple-100 transition-all duration-500 group">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-700 rounded-2xl flex items-center justify-center text-white text-3xl mb-8 group-hover:rotate-12 transition-transform">
                        👥
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Guest Management</h3>
                    <p class="text-gray-500 leading-relaxed">
                        সব গেস্ট এক জায়গায় সুন্দরভাবে সাজানো। মোবাইল থেকেই দ্রুত গেস্ট যোগ করুন।
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="p-10 bg-white rounded-[2.5rem] shadow-sm border border-gray-100 hover:shadow-2xl hover:shadow-pink-100 transition-all duration-500 group">
                    <div class="w-16 h-16 bg-gradient-to-br from-pink-500 to-pink-700 rounded-2xl flex items-center justify-center text-white text-3xl mb-8 group-hover:rotate-12 transition-transform">
                        💰
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Gift Tracking</h3>
                    <p class="text-gray-500 leading-relaxed">
                        Cash বা Item—যেকোনো গিফট নিমেষেই ট্র্যাক করুন। ইভেন্ট মোড দিয়ে দ্রুত এন্ট্রি।
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="p-10 bg-white rounded-[2.5rem] shadow-sm border border-gray-100 hover:shadow-2xl hover:shadow-orange-100 transition-all duration-500 group">
                    <div class="w-16 h-16 bg-gradient-to-br from-orange-400 to-orange-600 rounded-2xl flex items-center justify-center text-white text-3xl mb-8 group-hover:rotate-12 transition-transform">
                        📊
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Instant Analytics</h3>
                    <p class="text-gray-500 leading-relaxed">
                        ইভেন্ট চলাকালীন বা পরে তাৎক্ষণিক রিপোর্ট ও হিসাব। মোট কত কালেকশন হলো এক পলকেই।
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ⚡ HOW IT WORKS -->
    <section class="py-24 bg-gray-900 text-white rounded-[3rem] mx-4 md:mx-12 overflow-hidden relative">
        <div class="absolute top-0 left-0 w-full h-full opacity-10 bg-[url('https://www.transparenttextures.com/patterns/diamond-upholstery.png')]"></div>
        
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <h2 class="text-4xl md:text-5xl font-black text-center mb-20">How It Works</h2>

            <div class="grid md:grid-cols-3 gap-12 relative">
                <!-- Connector lines (hidden on mobile) -->
                <div class="hidden md:block absolute top-1/4 left-1/4 w-1/2 h-0.5 border-t-2 border-dashed border-gray-700 -z-10"></div>

                <div class="text-center group">
                    <div class="w-20 h-20 bg-gray-800 rounded-full flex items-center justify-center text-3xl font-black border-4 border-purple-500 mx-auto mb-8 group-hover:scale-110 transition-transform bg-clip-text text-transparent bg-gradient-to-b from-white to-gray-400">
                        1
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Create Account</h3>
                    <p class="text-gray-400">নিজে সাইন আপ করুন এবং আপনার ইভেন্ট সেটআপ করুন।</p>
                </div>

                <div class="text-center group">
                    <div class="w-20 h-20 bg-gray-800 rounded-full flex items-center justify-center text-3xl font-black border-4 border-pink-500 mx-auto mb-8 group-hover:scale-110 transition-transform bg-clip-text text-transparent bg-gradient-to-b from-white to-gray-400">
                        2
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Quick Data Entry</h3>
                    <p class="text-gray-400">ইভেন্টের সময় মোবাইল দিয়ে দ্রুত গেস্ট ও গিফট এন্ট্রি দিন।</p>
                </div>

                <div class="text-center group">
                    <div class="w-20 h-20 bg-gray-800 rounded-full flex items-center justify-center text-3xl font-black border-4 border-orange-400 mx-auto mb-8 group-hover:scale-110 transition-transform bg-clip-text text-transparent bg-gradient-to-b from-white to-gray-400">
                        3
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Relax & Analyze</h3>
                    <p class="text-gray-400">পুরো ইভেন্টের সামারি দেখুন এবং ডাটা এক্সপোর্ট করুন।</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 📸 DEMO PREVIEW -->
    <section id="demo" class="py-24">
        <div class="max-w-7xl mx-auto px-6">
            <div class="bg-gradient-to-br from-purple-600 to-pink-500 rounded-[3rem] p-8 md:p-20 text-white text-center relative overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 blur-[80px] rounded-full"></div>
                <div class="absolute bottom-0 left-0 w-64 h-64 bg-black/10 blur-[80px] rounded-full"></div>
                
                <h2 class="text-4xl md:text-5xl font-black mb-8">Ready to see it in action?</h2>
                <p class="text-xl mb-12 text-purple-50 max-w-2xl mx-auto font-medium">
                    Our dashboard is designed to be mobile-first, ensuring you can manage gifts even in the middle of a busy wedding ceremony.
                </p>
                
                <div class="max-w-5xl mx-auto bg-white/10 backdrop-blur-md p-4 rounded-[2rem] border border-white/20 shadow-2xl">
                    <img src="/images/dashboard.png" alt="Dashboard Preview" class="rounded-2xl w-full shadow-lg" />
                </div>
            </div>
        </div>
    </section>

    <!-- 💰 PRICING -->
    <section class="py-24">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-20">
                <h2 class="text-4xl md:text-5xl font-black mb-6">Simple, Transparent Pricing</h2>
                <p class="text-gray-500 text-lg font-medium">Choose the plan that fits your event size</p>
            </div>

            <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto items-center">
                <!-- Free -->
                <div class="p-10 bg-white rounded-[2.5rem] border-2 border-gray-100 hover:border-purple-200 transition-all group">
                    <h3 class="text-xl font-bold text-gray-500 mb-2 uppercase tracking-widest">Free Plan</h3>
                    <div class="flex items-baseline gap-1 mb-8">
                        <span class="text-5xl font-black text-gray-900">৳0</span>
                        <span class="text-gray-400 font-medium">/event</span>
                    </div>
                    
                    <ul class="space-y-4 mb-10">
                        <li class="flex items-center gap-3 text-gray-600">
                            <span class="text-green-500 text-xl">✓</span> Up to 50 Guests
                        </li>
                        <li class="flex items-center gap-3 text-gray-600">
                            <span class="text-green-500 text-xl">✓</span> Basic Gift Tracking
                        </li>
                        <li class="flex items-center gap-3 text-gray-400 line-through">
                            <span>×</span> PDF Export
                        </li>
                    </ul>

                    <Link :href="route('register')" class="block w-full py-4 text-center border-2 border-purple-600 text-purple-600 font-bold rounded-2xl hover:bg-purple-50 transition-colors">
                        Start for Free
                    </Link>
                </div>

                <!-- Pro -->
                <div class="p-12 bg-gray-900 rounded-[2.5rem] shadow-2xl shadow-purple-200 relative overflow-hidden group">
                    <div class="absolute top-0 right-0 px-6 py-2 bg-purple-600 text-white text-xs font-black uppercase rounded-bl-2xl">
                        Recommended
                    </div>
                    
                    <h3 class="text-xl font-bold text-purple-400 mb-2 uppercase tracking-widest">Pro Plan</h3>
                    <div class="flex items-baseline gap-1 mb-8">
                        <span class="text-5xl font-black text-white">৳199</span>
                        <span class="text-gray-400 font-medium">/event</span>
                    </div>
                    
                    <ul class="space-y-4 mb-10">
                        <li class="flex items-center gap-3 text-gray-200">
                            <span class="text-purple-500 text-xl">✓</span> Unlimited Guests
                        </li>
                        <li class="flex items-center gap-3 text-gray-200">
                            <span class="text-purple-500 text-xl">✓</span> Advanced Analytics
                        </li>
                        <li class="flex items-center gap-3 text-gray-200">
                            <span class="text-purple-500 text-xl">✓</span> Export to PDF & Excel
                        </li>
                        <li class="flex items-center gap-3 text-gray-200">
                            <span class="text-purple-500 text-xl">✓</span> Priority Support
                        </li>
                    </ul>

                    <Link :href="route('register')" class="block w-full py-4 text-center bg-gradient-to-r from-purple-600 to-pink-500 text-white font-bold rounded-2xl shadow-lg shadow-purple-900/20 hover:shadow-purple-900/40 transition-all hover:-translate-y-1">
                        Go Pro Now
                    </Link>
                </div>
            </div>
        </div>
    </section>

    <!-- 🚀 CTA -->
    <section class="py-24 px-6">
      <div class="max-w-5xl mx-auto rounded-[3rem] bg-gradient-to-br from-purple-800 via-purple-700 to-pink-600 p-12 md:p-24 text-center text-white relative overflow-hidden">
          <div class="absolute top-0 left-0 w-full h-full opacity-20 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
          
          <h2 class="text-4xl md:text-6xl font-black mb-8 relative z-10 leading-tight">
            Start Tracking Your Wedding Gifts Today 💜
          </h2>
          <p class="text-xl text-purple-100 mb-12 relative z-10 max-w-2xl mx-auto">
            Join thousands of couples who made their wedding gift management stress-free.
          </p>

          <Link :href="route('register')"
             class="relative z-10 inline-block px-12 py-5 bg-white text-purple-800 rounded-2xl font-black text-xl shadow-2xl hover:bg-gray-50 transition-all hover:scale-105 active:scale-95">
            Create Free Account
          </Link>
      </div>
    </section>

    <!-- 🔻 FOOTER -->
    <footer class="py-12 border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-center gap-8">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-purple-600 rounded-lg flex items-center justify-center text-white font-bold text-sm">W</div>
                    <span class="text-xl font-bold text-gray-900">WeddingGift</span>
                </div>
                
                <div class="flex items-center gap-8 text-sm font-bold text-gray-500">
                    <a href="#" class="hover:text-purple-600 transition-colors">About</a>
                    <a href="#" class="hover:text-purple-600 transition-colors">Privacy</a>
                    <a href="#" class="hover:text-purple-600 transition-colors">Terms</a>
                    <a href="#" class="hover:text-purple-600 transition-colors">Contact</a>
                </div>
                
                <div class="text-gray-400 text-sm font-medium">
                    © 2026 WeddingGift — Built with ❤️ by <a href="#" class="text-purple-600 font-bold">SP Tech BD</a>
                </div>
            </div>
        </div>
    </footer>
  </div>
</template>

<style scoped>
@keyframes bounce-slow {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}
.animate-bounce-slow {
    animation: bounce-slow 3s infinite ease-in-out;
}
</style>