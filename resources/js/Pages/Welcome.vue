<script setup>
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
<<<<<<< HEAD
  <Head title="SP Tech BD — The Ultimate Wedding Gift Manager" />
=======
  <Head title="Welcome -  SP Tech BD" />
>>>>>>> ab8016a57718c7c8119e32d07693d79b7f237d1e
  
  <div class="min-h-screen bg-[#fcfaff] font-sans text-gray-900 selection:bg-purple-100 selection:text-purple-900">
    
    <!-- 🌟 PREMIUM NAVBAR -->
    <header class="fixed top-0 left-0 right-0 z-50 flex justify-between items-center px-6 md:px-16 py-6 bg-white/80 backdrop-blur-xl border-b border-purple-50/50">
      <div class="flex items-center gap-3 group cursor-pointer">
        <div class="w-10 h-10 bg-gradient-to-tr from-purple-600 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-purple-200 group-hover:scale-110 transition-transform">
            <span class="text-white font-black text-xl">S</span>
        </div>
        <div class="flex flex-col">
            <span class="text-xl font-black bg-clip-text text-transparent bg-gradient-to-r from-purple-600 to-indigo-600 tracking-tighter leading-none">
                SP Tech BD
            </span>
            <span class="text-[10px] font-bold text-gray-400 tracking-[0.2em] uppercase leading-none mt-1">Wedding Manager</span>
        </div>
      </div>

      <div class="hidden lg:flex items-center space-x-10">
        <a href="#features" class="text-sm font-bold text-gray-500 hover:text-purple-600 transition-colors">Features</a>
        <a href="#how-it-works" class="text-sm font-bold text-gray-500 hover:text-purple-600 transition-colors">How it works</a>
        <a href="#pricing" class="text-sm font-bold text-gray-500 hover:text-purple-600 transition-colors">Pricing</a>
      </div>

      <div class="flex items-center space-x-4">
        <Link :href="route('login')" class="hidden md:block text-sm font-bold text-gray-600 hover:text-purple-600 transition-colors">
            Sign In
        </Link>
        <Link :href="route('register')" class="px-8 py-3 bg-gray-900 text-white text-sm font-bold rounded-2xl shadow-xl hover:bg-purple-600 hover:shadow-purple-200 transition-all active:scale-95">
          Get Started
        </Link>
      </div>
    </header>

    <!-- 🚀 ULTRA-PREMIUM HERO -->
    <section class="relative pt-40 pb-20 md:pt-56 md:pb-40 overflow-hidden">
        <!-- Floating Decorative Elements -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full -z-10">
            <div class="absolute top-[-20%] left-[-10%] w-[60%] h-[60%] bg-purple-100/40 blur-[140px] rounded-full"></div>
            <div class="absolute bottom-[-20%] right-[-10%] w-[60%] h-[60%] bg-indigo-100/40 blur-[140px] rounded-full"></div>
        </div>

        <div class="max-w-7xl mx-auto px-6 text-center">
            <div class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-white shadow-sm border border-purple-50 text-purple-600 text-[13px] font-bold mb-10 animate-fade-in-up">
                <span class="flex h-2 w-2 rounded-full bg-purple-500 animate-pulse"></span>
                Trusted by 5,000+ Couples across Bangladesh 🇧🇩
            </div>

            <h1 class="text-6xl md:text-8xl font-black mb-8 leading-[1.05] tracking-tight text-gray-900 animate-fade-in-up" style="animation-delay: 0.1s">
                Preserve Every <br class="hidden md:block" />
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-purple-600 via-indigo-500 to-pink-500">
                    Blessing Digitally ✨
                </span>
            </h1>

            <p class="text-xl md:text-2xl mb-12 max-w-3xl mx-auto text-gray-500 leading-relaxed font-medium animate-fade-in-up" style="animation-delay: 0.2s">
                আপনার বিশেষ দিনের প্রতিটি উপহার ও আশীর্বাদ সুন্দরভাবে সাজিয়ে রাখুন। 
                <span class="text-purple-600 font-bold">SP Tech BD</span> নিয়ে এসেছে বাংলাদেশের সেরা ওয়েডিং গিফট ট্র্যাকিং সলিউশন।
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-5 mb-24 animate-fade-in-up" style="animation-delay: 0.3s">
                <Link :href="route('register')"
                   class="w-full sm:w-auto px-12 py-5 bg-purple-600 text-white rounded-2xl font-black text-xl shadow-2xl shadow-purple-200 hover:bg-purple-700 hover:shadow-purple-400 transition-all hover:-translate-y-1">
                  Start Your Registry — Free
                </Link>

                <a href="#features"
                   class="w-full sm:w-auto px-12 py-5 bg-white border-2 border-purple-100 text-purple-600 rounded-2xl font-black text-xl hover:bg-purple-50 transition-all">
                  See Features
                </a>
            </div>
            
            <!-- Dashboard Mockup -->
            <div class="relative group animate-fade-in-up" style="animation-delay: 0.4s">
                <div class="absolute inset-x-0 -bottom-24 h-96 bg-gradient-to-t from-[#fcfaff] via-[#fcfaff]/80 to-transparent z-10"></div>
                <div class="absolute -inset-10 bg-gradient-to-r from-purple-600 to-indigo-600 rounded-[4rem] blur-3xl opacity-10 group-hover:opacity-20 transition-opacity duration-700"></div>
                
                <div class="relative z-0 rounded-[2rem] md:rounded-[3rem] p-3 md:p-6 bg-white shadow-[0_40px_100px_-20px_rgba(0,0,0,0.15)] border border-purple-50 max-w-6xl mx-auto overflow-hidden">
                    <img src="/images/dashboard.png" alt="SP Tech BD Dashboard" 
                         class="w-full rounded-[1.5rem] md:rounded-[2.5rem] transform transition-transform duration-1000 group-hover:scale-[1.02]" />
                </div>
            </div>
        </div>
    </section>

    <!-- 🤝 TRUST INDICATORS -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p class="text-xs font-black text-gray-400 uppercase tracking-[0.3em] mb-12">Designed for the modern family</p>
            <div class="flex flex-wrap justify-center items-center gap-12 md:gap-24 opacity-40 grayscale hover:grayscale-0 transition-all duration-500">
                <span class="text-3xl font-black text-gray-900">BRIDE & GROOM</span>
                <span class="text-3xl font-black text-gray-900">FAMILY FIRST</span>
                <span class="text-3xl font-black text-gray-900">DESHI WEDDINGS</span>
                <span class="text-3xl font-black text-gray-900">GIFT PORTAL</span>
            </div>
        </div>
    </section>

    <!-- 💡 WHY CHOOSE US? -->
    <section id="features" class="py-32 relative">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-3xl mx-auto mb-24">
                <h2 class="text-4xl md:text-6xl font-black mb-8 leading-tight">Everything you need to <br />manage with ease</h2>
                <p class="text-xl text-gray-500 font-medium">আমরা বুঝি একটি বিয়েতে কত হাজার কাজ থাকে। তাই উপহারের হিসাব করার দায়িত্বটা আমাদের উপর ছেড়ে দিন।</p>
            </div>

            <div class="grid md:grid-cols-3 gap-10">
                <!-- Feature 1 -->
                <div class="group p-10 bg-white rounded-[3rem] border border-purple-50 shadow-sm hover:shadow-[0_40px_80px_-20px_rgba(124,58,237,0.1)] transition-all duration-500">
                    <div class="w-20 h-20 bg-purple-50 rounded-3xl flex items-center justify-center text-4xl mb-10 group-hover:bg-purple-600 group-hover:text-white transition-all duration-500">
                        ⚡
                    </div>
                    <h3 class="text-2xl font-black mb-6">Ultra-Fast Entry</h3>
                    <p class="text-gray-500 leading-relaxed text-lg">
                        ইভেন্ট মোড দিয়ে আপনি এক মিনিটে ১০ জন গেস্টের গিফট এন্ট্রি করতে পারবেন। কোনো মাউস লাগবে না, শুধু এন্টার চাপুন।
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="group p-10 bg-white rounded-[3rem] border border-purple-50 shadow-sm hover:shadow-[0_40px_80px_-20px_rgba(236,72,153,0.1)] transition-all duration-500">
                    <div class="w-20 h-20 bg-pink-50 rounded-3xl flex items-center justify-center text-4xl mb-10 group-hover:bg-pink-600 group-hover:text-white transition-all duration-500">
                        📱
                    </div>
                    <h3 class="text-2xl font-black mb-6">Mobile Focused</h3>
                    <p class="text-gray-500 leading-relaxed text-lg">
                        আপনার স্মার্টফোন থেকেই সব হ্যান্ডেল করুন। আলাদা কোনো অ্যাপ ডাউনলোড করার প্রয়োজন নেই, সরাসরি ব্রাউজারেই দারুণ কাজ করে।
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="group p-10 bg-white rounded-[3rem] border border-purple-50 shadow-sm hover:shadow-[0_40px_80px_-20px_rgba(59,130,246,0.1)] transition-all duration-500">
                    <div class="w-20 h-20 bg-blue-50 rounded-3xl flex items-center justify-center text-4xl mb-10 group-hover:bg-blue-600 group-hover:text-white transition-all duration-500">
                        📑
                    </div>
                    <h3 class="text-2xl font-black mb-6">Smart Reports</h3>
                    <p class="text-gray-500 leading-relaxed text-lg">
                        অনুষ্ঠান শেষে এক ক্লিকেই পুরো উপহারের লিস্ট ডাউনলোড করুন। Excel বা PDF — যা আপনার পছন্দ। হিসাব হবে একদম নিখুঁত।
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ⚡ HOW IT WORKS (STORY STYLE) -->
    <section id="how-it-works" class="py-32 bg-gray-900 text-white rounded-[4rem] mx-4 md:mx-12 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-full h-full opacity-5 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')]"></div>
        
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="text-center mb-24">
                <h2 class="text-4xl md:text-6xl font-black mb-8">From Chaos to Clarity</h2>
                <p class="text-gray-400 text-xl max-w-2xl mx-auto">তিনটি সহজ ধাপে আপনার গিফট ম্যানেজমেন্ট শুরু করুন</p>
            </div>

            <div class="grid md:grid-cols-2 gap-20 items-center">
                <div class="space-y-12">
                    <div class="flex gap-8 group">
                        <div class="flex-shrink-0 w-14 h-14 bg-purple-600 rounded-full flex items-center justify-center font-black text-xl">1</div>
                        <div>
                            <h4 class="text-2xl font-bold mb-3 group-hover:text-purple-400 transition-colors">Create Your Celebration</h4>
                            <p class="text-gray-400 leading-relaxed">মিনিটেই ফ্রি একাউন্ট খুলুন এবং আপনার ইভেন্টের নাম ও তারিখ সেট করুন।</p>
                        </div>
                    </div>

                    <div class="flex gap-8 group">
                        <div class="flex-shrink-0 w-14 h-14 bg-indigo-600 rounded-full flex items-center justify-center font-black text-xl">2</div>
                        <div>
                            <h4 class="text-2xl font-bold mb-3 group-hover:text-indigo-400 transition-colors">Rapid Entry during Event</h4>
                            <p class="text-gray-400 leading-relaxed">অনুষ্ঠানের গেটে বসেই গেস্টদের নাম ও গিফট টাইপ করুন। দেরি হবে না একদম।</p>
                        </div>
                    </div>

                    <div class="flex gap-8 group">
                        <div class="flex-shrink-0 w-14 h-14 bg-pink-600 rounded-full flex items-center justify-center font-black text-xl">3</div>
                        <div>
                            <h4 class="text-2xl font-bold mb-3 group-hover:text-pink-400 transition-colors">Instant Analysis & Export</h4>
                            <p class="text-gray-400 leading-relaxed">অনুষ্ঠান শেষে সব ডাটা আপনার হাতের মুঠোয়। কাকে থ্যাংক ইউ দিতে হবে তাও জানুন।</p>
                        </div>
                    </div>
                </div>

                <div class="relative">
                    <div class="absolute inset-0 bg-purple-500 blur-[100px] opacity-20"></div>
                    <div class="relative bg-gray-800 rounded-[3rem] p-8 border border-gray-700 shadow-2xl">
                        <div class="flex items-center gap-2 mb-8">
                            <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                            <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                            <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                        </div>
                        <div class="space-y-4">
                            <div class="h-10 bg-gray-700 rounded-xl w-3/4 animate-pulse"></div>
                            <div class="h-24 bg-gray-700/50 rounded-xl w-full animate-pulse"></div>
                            <div class="h-20 bg-gray-700/50 rounded-xl w-full animate-pulse"></div>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="h-32 bg-purple-900/30 rounded-xl border border-purple-500/30"></div>
                                <div class="h-32 bg-indigo-900/30 rounded-xl border border-indigo-500/30"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 💰 PRICING -->
    <section id="pricing" class="py-32">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-24">
                <h2 class="text-4xl md:text-6xl font-black mb-8">Simple Plans for Huge Days</h2>
                <p class="text-gray-500 text-xl">স্বচ্ছ দাম, কোনো লুকানো চার্জ নেই।</p>
            </div>

            <div class="grid md:grid-cols-2 gap-10 max-w-5xl mx-auto">
                <!-- Free -->
                <div class="p-12 bg-white rounded-[4rem] border-2 border-gray-100 hover:border-purple-200 transition-all duration-500 group relative">
                    <h3 class="text-xl font-bold text-gray-400 mb-6 uppercase tracking-widest">Essentials</h3>
                    <div class="flex items-baseline gap-2 mb-10">
                        <span class="text-7xl font-black text-gray-900">৳0</span>
                        <span class="text-gray-400 text-lg font-bold">/event</span>
                    </div>
                    
                    <ul class="space-y-6 mb-12">
                        <li class="flex items-center gap-4 text-gray-600 font-bold">
                            <span class="w-6 h-6 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-xs">✓</span> Up to 50 Guests
                        </li>
                        <li class="flex items-center gap-4 text-gray-600 font-bold">
                            <span class="w-6 h-6 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-xs">✓</span> Real-time Dashboard
                        </li>
                        <li class="flex items-center gap-4 text-gray-400 font-bold line-through">
                            <span>×</span> PDF/Excel Export
                        </li>
                        <li class="flex items-center gap-4 text-gray-400 font-bold line-through">
                            <span>×</span> Multi-event Management
                        </li>
                    </ul>

                    <Link :href="route('register')" class="block w-full py-5 text-center bg-gray-50 text-gray-900 font-black rounded-3xl hover:bg-gray-900 hover:text-white transition-all text-xl">
                        Start for Free
                    </Link>
                </div>

                <!-- Pro -->
                <div class="p-12 bg-gray-900 rounded-[4rem] shadow-[0_50px_100px_-20px_rgba(124,58,237,0.3)] relative overflow-hidden group transform hover:-translate-y-2 transition-all duration-500">
                    <div class="absolute top-0 right-0 px-10 py-3 bg-purple-600 text-white text-xs font-black uppercase rounded-bl-[2rem] tracking-widest">
                        Most Popular
                    </div>
                    
                    <h3 class="text-xl font-bold text-purple-400 mb-6 uppercase tracking-widest">Pro Celebration</h3>
                    <div class="flex items-baseline gap-2 mb-10">
                        <span class="text-7xl font-black text-white">৳199</span>
                        <span class="text-gray-500 text-lg font-bold">/event</span>
                    </div>
                    
                    <ul class="space-y-6 mb-12 text-white/90">
                        <li class="flex items-center gap-4 font-bold">
                            <span class="w-6 h-6 bg-purple-600 text-white rounded-full flex items-center justify-center text-xs text-bold">✓</span> Unlimited Guest Entry
                        </li>
                        <li class="flex items-center gap-4 font-bold">
                            <span class="w-6 h-6 bg-purple-600 text-white rounded-full flex items-center justify-center text-xs text-bold">✓</span> PDF & Excel Export
                        </li>
                        <li class="flex items-center gap-4 font-bold">
                            <span class="w-6 h-6 bg-purple-600 text-white rounded-full flex items-center justify-center text-xs text-bold">✓</span> Advanced Analytics
                        </li>
                        <li class="flex items-center gap-4 font-bold">
                            <span class="w-6 h-6 bg-purple-600 text-white rounded-full flex items-center justify-center text-xs text-bold">✓</span> Priority Support
                        </li>
                    </ul>

                    <Link :href="route('register')" class="block w-full py-5 text-center bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-black rounded-3xl shadow-xl hover:shadow-purple-500/40 transition-all text-xl">
                        Unlock Everything
                    </Link>
                </div>
            </div>
        </div>
    </section>

    <!-- 🚀 FINAL CTA -->
    <section class="py-32 px-6">
      <div class="max-w-6xl mx-auto rounded-[5rem] bg-gradient-to-br from-purple-950 via-purple-900 to-indigo-900 p-16 md:p-32 text-center text-white relative overflow-hidden shadow-3xl">
          <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/asfalt-dark.png')]"></div>
          <div class="absolute -top-20 -left-20 w-80 h-80 bg-purple-600 blur-[120px] opacity-20"></div>
          <div class="absolute -bottom-20 -right-20 w-80 h-80 bg-indigo-600 blur-[120px] opacity-20"></div>
          
          <h2 class="text-5xl md:text-7xl font-black mb-10 relative z-10 leading-tight">
            Ready to make your <br />wedding stress-free?
          </h2>
          <p class="text-2xl text-purple-200/80 mb-16 relative z-10 max-w-2xl mx-auto font-medium">
            Join thousands of happy couples who trusted SP Tech BD with their special day.
          </p>

          <Link :href="route('register')"
             class="relative z-10 inline-block px-16 py-6 bg-white text-gray-900 rounded-[2rem] font-black text-2xl shadow-[0_20px_50px_rgba(255,255,255,0.2)] hover:bg-gray-50 transition-all hover:scale-105 active:scale-95">
            Create Your Account
          </Link>
      </div>
    </section>

    <!-- 🔻 FOOTER -->
    <footer class="py-20 border-t border-purple-50 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid md:grid-cols-4 gap-12 mb-20">
                <div class="col-span-2">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-10 h-10 bg-gray-900 rounded-xl flex items-center justify-center text-white font-black">S</div>
                        <span class="text-2xl font-black text-gray-900 tracking-tighter">SP Tech BD</span>
                    </div>
                    <p class="text-gray-400 text-lg max-w-sm font-medium leading-relaxed">
                        Helping couples preserve their wedding blessings digitally since 2026. Part of the SP Tech ecosystem.
                    </p>
                </div>
                
                <div>
                    <h5 class="font-black text-gray-900 mb-8 uppercase tracking-widest text-xs">Product</h5>
                    <ul class="space-y-4 font-bold text-gray-500">
                        <li><a href="#features" class="hover:text-purple-600 transition-colors">Features</a></li>
                        <li><a href="#pricing" class="hover:text-purple-600 transition-colors">Pricing</a></li>
                        <li><a href="#" class="hover:text-purple-600 transition-colors">Demo</a></li>
                        <li><a href="#" class="hover:text-purple-600 transition-colors">Updates</a></li>
                    </ul>
                </div>

                <div>
                    <h5 class="font-black text-gray-900 mb-8 uppercase tracking-widest text-xs">Support</h5>
                    <ul class="space-y-4 font-bold text-gray-500">
                        <li><a href="#" class="hover:text-purple-600 transition-colors">Help Center</a></li>
                        <li><a href="#" class="hover:text-purple-600 transition-colors">Privacy</a></li>
                        <li><a href="#" class="hover:text-purple-600 transition-colors">Terms</a></li>
                        <li><a href="#" class="hover:text-purple-600 transition-colors">Contact</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="flex flex-col md:flex-row justify-between items-center pt-12 border-t border-purple-50 gap-6">
                <div class="text-gray-400 text-sm font-black uppercase tracking-[0.2em]">
                  © SP Tech BD 2026. All Rights Reserved. Developed by  <a href="https://sauravpal.xyz/" target="_blank" class="text-purple-600 font-black hover:underline">Saurav Pal</a>
               
          
            </div>
        </div>
    </footer>
  </div>
</template>

<style scoped>
@keyframes fade-in-up {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in-up {
    animation: fade-in-up 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
    opacity: 0;
}
</style>
