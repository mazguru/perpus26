

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Under Construction</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f0f4f8 0%, #d9e2ec 100%);
            min-height: 100vh;
        }
        
        .construction-animation {
            animation: float 3s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-12px);
            }
        }
        
        .progress-bar {
            background: rgba(255, 255, 255, 0.5);
            border-radius: 8px;
            height: 8px;
            overflow: hidden;
            position: relative;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        
        .progress-fill {
            background: linear-gradient(90deg, #2563eb, #3b82f6);
            height: 100%;
            border-radius: 8px;
            animation: progress 3s ease-in-out infinite;
            width: 75%;
        }
        
        @keyframes progress {
            0% {
                width: 35%;
            }
            50% {
                width: 75%;
            }
            100% {
                width: 35%;
            }
        }
        
        .card {
            background-color: white;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        }
        
        .social-icon {
            transition: all 0.3s ease;
        }
        
        .social-icon:hover {
            transform: translateY(-3px);
        }
    </style>
</head>
<body>
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="card max-w-3xl w-full rounded-xl p-8 md:p-12 text-center">
            <div class="flex justify-center mb-8">
                <svg class="construction-animation w-24 h-24 md:w-32 md:h-32" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="32" cy="32" r="28" fill="#EBF5FF" stroke="#2563EB" stroke-width="2"/>
                    <path d="M20 32L28 40L44 24" stroke="#2563EB" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M32 16V22" stroke="#2563EB" stroke-width="2" stroke-linecap="round"/>
                    <path d="M46.1421 21.8579L41.8995 26.1005" stroke="#2563EB" stroke-width="2" stroke-linecap="round"/>
                    <path d="M52 36H46" stroke="#2563EB" stroke-width="2" stroke-linecap="round"/>
                    <path d="M46.1421 50.1421L41.8995 45.8995" stroke="#2563EB" stroke-width="2" stroke-linecap="round"/>
                    <path d="M32 52V46" stroke="#2563EB" stroke-width="2" stroke-linecap="round"/>
                    <path d="M17.8579 50.1421L22.1005 45.8995" stroke="#2563EB" stroke-width="2" stroke-linecap="round"/>
                    <path d="M12 36H18" stroke="#2563EB" stroke-width="2" stroke-linecap="round"/>
                    <path d="M17.8579 21.8579L22.1005 26.1005" stroke="#2563EB" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </div>
            
            <h1 class="text-3xl md:text-4xl font-bold mb-4 text-gray-800">Website Under Construction</h1>
            <p class="text-lg text-gray-600 mb-8">We're working on creating something amazing. Our new website will be ready soon.</p>
            
            <div class="mb-10">
                <div class="progress-bar mb-2">
                    <div class="progress-fill"></div>
                </div>
                <p class="text-gray-500 text-sm">Development in progress: 75% Complete</p>
            </div>
            
            <div class="mb-10">
                <form class="flex flex-col md:flex-row gap-3 max-w-md mx-auto">
                    <input type="email" placeholder="Enter your email" class="flex-1 px-4 py-3 rounded-lg focus:outline-none border border-gray-200 text-gray-700 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-200" required>
                    <button type="submit" class="px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-all focus:ring-4 focus:ring-blue-200">Notify Me</button>
                </form>
                <p class="text-gray-500 text-sm mt-2">We'll let you know when we launch</p>
            </div>
            
            <div class="flex justify-center space-x-6 mb-8">
                <a href="#" class="social-icon text-blue-500 hover:text-blue-600">
                    <i class="fab fa-facebook-f text-xl"></i>
                </a>
                <a href="#" class="social-icon text-blue-500 hover:text-blue-600">
                    <i class="fab fa-twitter text-xl"></i>
                </a>
                <a href="#" class="social-icon text-blue-500 hover:text-blue-600">
                    <i class="fab fa-instagram text-xl"></i>
                </a>
                <a href="#" class="social-icon text-blue-500 hover:text-blue-600">
                    <i class="fab fa-linkedin-in text-xl"></i>
                </a>
            </div>
            
            <div class="pt-6 border-t border-gray-100 text-gray-400 text-sm">
                <p>© 2023 Your Company. All rights reserved.</p>
            </div>
        </div>
    </div>

    <script>
        // Form submission handler
        document.querySelector('form').addEventListener('submit', function(e) {
            e.preventDefault();
            const email = this.querySelector('input[type="email"]').value;
            if (email) {
                // Create notification element
                const notification = document.createElement('div');
                notification.className = 'fixed top-4 right-4 bg-green-50 text-green-800 px-6 py-3 rounded-lg shadow-lg';
                notification.innerHTML = `
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>Thank you! We'll notify you when we launch.</span>
                    </div>
                `;
                document.body.appendChild(notification);
                
                // Remove notification after 3 seconds
                setTimeout(() => {
                    notification.style.opacity = '0';
                    notification.style.transition = 'opacity 0.5s ease';
                    setTimeout(() => notification.remove(), 500);
                }, 3000);
                
                this.reset();
            }
        });
    </script>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'9664ab4d92a5fe1d',t:'MTc1MzcwODc3Ni4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>
