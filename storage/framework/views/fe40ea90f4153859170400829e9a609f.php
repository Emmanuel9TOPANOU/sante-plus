<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    
    <title><?php echo e(config('app.name', 'Santé+')); ?> | <?php echo e(isset($header) ? strip_tags($header) : 'Gestion Clinique'); ?></title>

    <link rel="icon" type="image/png" href="<?php echo e(asset('logo-sante-plus.png')); ?>">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <style>
        body { font-family: 'Outfit', sans-serif; }
        .alert-fade-out { opacity: 0; transform: translateY(-20px) scale(0.95); transition: all 0.5s ease-in-out; }
    </style>
</head>
<body class="antialiased text-slate-900 bg-[#F8FAFC]"> 
    
    
    <?php if(session('success')): ?>
        <div id="success-alert" class="fixed top-6 right-6 z-[100] transform transition-all duration-500 ease-out">
            <div class="bg-slate-900 text-white px-6 py-4 rounded-[2rem] shadow-2xl flex items-center space-x-4 border border-blue-500/30 backdrop-blur-xl">
                <div class="bg-blue-600 p-2 rounded-xl shadow-lg shadow-blue-500/40">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-blue-400">Système</p>
                    <p class="text-sm font-bold tracking-tight text-slate-100"><?php echo e(session('success')); ?></p>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="min-h-screen relative z-10">
        <?php echo $__env->make('layouts.navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        
        <?php if(isset($header)): ?>
            <header class="bg-white/80 backdrop-blur-md border-b border-slate-200">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <h2 class="font-semibold text-xl text-slate-800 leading-tight">
                        <?php echo e($header); ?>

                    </h2>
                </div>
            </header>
        <?php endif; ?>

        <main>
            <div class="mx-auto">
                <?php echo e($slot); ?>

            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const alert = document.getElementById('success-alert');
            if (alert) {
                setTimeout(() => {
                    alert.classList.add('alert-fade-out');
                    setTimeout(() => {
                        alert.remove();
                    }, 500); 
                }, 3000);
            }
        });
    </script>
</body>
</html><?php /**PATH C:\Users\POSTE DETRAVAIL\Desktop\Soutenance\Santé+\resources\views/layouts/app.blade.php ENDPATH**/ ?>