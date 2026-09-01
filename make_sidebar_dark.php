<?php

$files = ['resources/views/layouts/admin.blade.php', 'resources/views/layouts/member.blade.php'];

foreach ($files as $f) {
    if (!file_exists($f)) continue;
    $c = file_get_contents($f);
    
    // Change <aside> background
    $c = str_replace('<aside class="border-b border-slate-200 bg-white px-6 py-6 lg:sticky lg:top-0 lg:h-screen lg:overflow-y-auto lg:border-b-0 lg:border-r">', '<aside class="border-b border-white/10 bg-slate-950 px-6 py-6 lg:sticky lg:top-0 lg:h-screen lg:overflow-y-auto lg:border-b-0 lg:border-r">', $c);
    
    // Change text colors in aside
    $c = str_replace('text-slate-500 hover:bg-slate-100 hover:text-slate-900', 'text-slate-400 hover:bg-white/5 hover:text-white', $c);
    $c = str_replace('text-sm font-semibold uppercase tracking-[0.28em] text-slate-500', 'text-sm font-semibold uppercase tracking-[0.28em] text-slate-300', $c);
    $c = str_replace('pt-4 text-xs font-semibold uppercase tracking-[0.26em] text-slate-400', 'pt-4 text-xs font-semibold uppercase tracking-[0.26em] text-slate-500', $c);
    $c = str_replace('pt-2 text-xs font-semibold uppercase tracking-[0.26em] text-slate-400', 'pt-2 text-xs font-semibold uppercase tracking-[0.26em] text-slate-500', $c);
    
    // Ensure "bg-cyan-50" active state for sidebar is adjusted for dark mode
    $c = str_replace('bg-cyan-50 text-cyan-800 font-bold border border-cyan-100', 'bg-cyan-900/30 text-cyan-300 font-bold border border-cyan-800/50', $c);
    
    // Adjust Logo box to be dark or transparent
    $c = str_replace('flex h-12 w-28 items-center overflow-hidden rounded-xl bg-white px-2 py-1 shadow-sm border border-slate-100', 'flex h-12 w-28 items-center overflow-hidden rounded-xl bg-white/10 px-2 py-1 shadow-sm border border-white/10', $c);
    
    file_put_contents($f, $c);
}

echo "Sidebars made dark\n";
