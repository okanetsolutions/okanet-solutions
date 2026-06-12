@csrf

<div class="space-y-8">
    <div>
        <label for="title" class="block font-mono text-xs text-greige uppercase tracking-widest mb-2">— Título</label>
        <input id="title" type="text" name="title" value="{{ old('title', $post->title ?? '') }}" required
            class="w-full bg-transparent border-0 border-b border-espresso/30 px-0 py-2 text-2xl font-display text-espresso placeholder-stone focus:outline-none focus:border-terracotta transition-colors"
            placeholder="Título del artículo">
        @error('title')<p class="mt-2 font-mono text-xs text-terracotta">{{ $message }}</p>@enderror
    </div>

    <div class="grid md:grid-cols-2 gap-x-8 gap-y-8">
        <div>
            <label for="slug" class="block font-mono text-xs text-greige uppercase tracking-widest mb-2">— Slug <span class="normal-case tracking-normal">(opcional, se genera del título)</span></label>
            <input id="slug" type="text" name="slug" value="{{ old('slug', $post->slug ?? '') }}"
                class="w-full bg-transparent border-0 border-b border-espresso/30 px-0 py-2 font-mono text-sm text-espresso placeholder-stone focus:outline-none focus:border-terracotta transition-colors"
                placeholder="mi-articulo">
            @error('slug')<p class="mt-2 font-mono text-xs text-terracotta">{{ $message }}</p>@enderror
        </div>
        <div class="flex items-end pb-2">
            <label class="inline-flex items-center gap-3 cursor-pointer select-none">
                <input type="hidden" name="published" value="0">
                <input type="checkbox" name="published" value="1" @checked(old('published', isset($post) && $post->isPublished())) class="w-4 h-4 accent-terracotta">
                <span class="font-mono text-xs uppercase tracking-widest text-umber">Publicado</span>
            </label>
        </div>
    </div>

    <div>
        <label for="excerpt" class="block font-mono text-xs text-greige uppercase tracking-widest mb-2">— Resumen <span class="normal-case tracking-normal">(opcional, aparece en el listado)</span></label>
        <textarea id="excerpt" name="excerpt" rows="2"
            class="w-full bg-transparent border-0 border-b border-espresso/30 px-0 py-2 text-espresso placeholder-stone focus:outline-none focus:border-terracotta transition-colors resize-none"
            placeholder="Una o dos frases que resuman el artículo...">{{ old('excerpt', $post->excerpt ?? '') }}</textarea>
        @error('excerpt')<p class="mt-2 font-mono text-xs text-terracotta">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="body" class="block font-mono text-xs text-greige uppercase tracking-widest mb-2">— Contenido <span class="normal-case tracking-normal">(Markdown: ## títulos, **negrita**, [enlaces](url), listas, código…)</span></label>
        <textarea id="body" name="body" rows="24" required
            class="w-full bg-paper border border-espresso/20 px-5 py-4 font-mono text-sm text-espresso placeholder-stone focus:outline-none focus:border-terracotta transition-colors leading-relaxed"
            placeholder="Escribe tu artículo en Markdown...">{{ old('body', $post->body ?? '') }}</textarea>
        @error('body')<p class="mt-2 font-mono text-xs text-terracotta">{{ $message }}</p>@enderror
    </div>

    <div class="flex items-center gap-6">
        <button type="submit" class="group inline-flex items-center gap-3 px-8 py-3.5 bg-espresso hover:bg-terracotta text-bone font-medium transition-colors">
            {{ $submitLabel }}
            <span class="font-mono text-xs group-hover:translate-x-1 transition-transform">→</span>
        </button>
        <a href="{{ route('admin.posts.index') }}" class="text-greige hover:text-espresso font-mono text-xs transition-colors">Cancelar</a>
    </div>
</div>
