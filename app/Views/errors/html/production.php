<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex">
    <title>Whoops! Something Went Wrong</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        <?= preg_replace('#[\r\n\t ]+#', ' ', file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'debug.css')) ?>
    </style>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .bounce-animation {
            animation: bounce 2s infinite;
        }
        
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-10px);
            }
            60% {
                transform: translateY(-5px);
            }
        }
        
        .float-animation {
            animation: float 3s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #ff7e5f 0%, #feb47b 100%);
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body class="gradient-bg min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full text-center">
        <!-- Floating Error Icon -->
        <div class="float-animation mb-8">
            <div class="inline-block p-6 rounded-full glass-effect">
                <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                </svg>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="glass-effect rounded-2xl p-8 shadow-2xl">
            <h1 class="text-4xl font-bold text-white mb-4 bounce-animation">
               <?= lang('Errors.whoops') ?> 🙈
            </h1>
            
            <p class="text-xl text-white/90 mb-2">
                Something went wrong
            </p>
            
            <p class="text-white/70 mb-8 leading-relaxed">
                Don't worry, it happens to the best of us! Our team has been notified and we're working on fixing this issue.<br><?= lang('Errors.weHitASnag') ?>
            </p>
            
            <!-- Action Buttons -->
            <div class="space-y-4">
                <button onclick="goHome()" class="w-full bg-white text-orange-600 font-semibold py-3 px-6 rounded-lg hover:bg-gray-100 transition-all duration-300 transform hover:scale-105 shadow-lg">
                    🏠 Go Home
                </button>
                
                <button onclick="goBack()" class="w-full bg-transparent border-2 border-white text-white font-semibold py-3 px-6 rounded-lg hover:bg-white hover:text-orange-600 transition-all duration-300 transform hover:scale-105">
                    ← Go Back
                </button>
                
                <button onclick="refreshPage()" class="w-full bg-transparent text-white/80 font-medium py-2 px-4 rounded-lg hover:text-white hover:bg-white/10 transition-all duration-300">
                    🔄 Try Again
                </button>
            </div>
            
            <!-- Error Code -->
            <div class="mt-8 pt-6 border-t border-white/20">
                <p class="text-white/50 text-sm">
                    Error Code: <span class="font-mono">WHOOPS_404</span>
                </p>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="mt-8 text-white/60 text-sm">
            <p>Need help? <a href="#" onclick="showContact()" class="text-white hover:underline">Contact Support</a></p>
        </div>
    </div>

    <script>
        function goHome() {
            window.location.href = '/';
        }
        
        function goBack() {
            if (window.history.length > 1) {
                window.history.back();
            } else {
                goHome();
            }
        }
        
        function refreshPage() {
            window.location.reload();
        }
        
        function showContact() {
            alert('Contact Support:\n\nEmail: support@example.com\nPhone: 1-800-WHOOPS\n\nWe\'re here to help! 😊');
        }
        
        // Add some interactive sparkle effects
        document.addEventListener('mousemove', function(e) {
            if (Math.random() > 0.95) {
                createSparkle(e.clientX, e.clientY);
            }
        });
        
        function createSparkle(x, y) {
            const sparkle = document.createElement('div');
            sparkle.innerHTML = '✨';
            sparkle.style.position = 'fixed';
            sparkle.style.left = x + 'px';
            sparkle.style.top = y + 'px';
            sparkle.style.pointerEvents = 'none';
            sparkle.style.fontSize = '12px';
            sparkle.style.zIndex = '1000';
            sparkle.style.animation = 'sparkleFloat 1s ease-out forwards';
            
            document.body.appendChild(sparkle);
            
            setTimeout(() => {
                sparkle.remove();
            }, 1000);
        }
        
        // Add sparkle animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes sparkleFloat {
                0% {
                    opacity: 1;
                    transform: translateY(0) scale(1);
                }
                100% {
                    opacity: 0;
                    transform: translateY(-50px) scale(0.5);
                }
            }
        `;
        document.head.appendChild(style);
    </script>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'969e165b367cf934',t:'MTc1NDMxMDg1MC4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>

