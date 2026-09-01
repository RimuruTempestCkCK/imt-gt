<?php

$files = [
    'resources/views/admin/users/index.blade.php',
    'resources/views/admin/cms/banners/index.blade.php'
];

foreach ($files as $f) {
    if (!file_exists($f)) continue;
    $c = file_get_contents($f);
    
    // Ensure dialog is perfectly centered with smooth backdrop
    $c = str_replace(
        'w-full max-w-xl rounded-2xl p-0 shadow-2xl backdrop:bg-slate-900/50 open:animate-in open:fade-in open:zoom-in-95', 
        'w-full max-w-xl m-auto rounded-[2rem] border border-slate-100 p-0 shadow-2xl backdrop:bg-slate-900/40 backdrop:backdrop-blur-sm open:animate-in open:fade-in open:zoom-in-95', 
        $c
    );
    
    // Banner modal size is 2xl
    $c = str_replace(
        'w-full max-w-2xl rounded-2xl p-0 shadow-2xl backdrop:bg-slate-900/50 open:animate-in open:fade-in open:zoom-in-95', 
        'w-full max-w-2xl m-auto rounded-[2rem] border border-slate-100 p-0 shadow-2xl backdrop:bg-slate-900/40 backdrop:backdrop-blur-sm open:animate-in open:fade-in open:zoom-in-95', 
        $c
    );
    
    // Make the header background softer
    $c = str_replace('px-6 py-4 flex justify-between items-center bg-slate-50', 'px-6 py-5 flex justify-between items-center bg-white rounded-t-[2rem]', $c);
    
    // Make the body background clean white
    $c = str_replace('p-6 space-y-4', 'p-6 md:p-8 space-y-5 bg-white', $c);
    $c = str_replace('p-6 space-y-5', 'p-6 md:p-8 space-y-6 bg-white', $c);
    
    // Soften inputs to white background instead of slate-50 inside body
    $c = str_replace('imtgt-input bg-slate-50', 'w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-3 text-sm focus:border-cyan-500 focus:bg-white focus:ring focus:ring-cyan-500/20 transition', $c);
    
    // Make footer background softer
    $c = str_replace('px-6 py-4 bg-slate-50 flex justify-end gap-3', 'px-6 py-5 bg-slate-50/50 flex justify-end gap-3 rounded-b-[2rem]', $c);
    
    file_put_contents($f, $c);
}

echo "Modals tidied\n";
