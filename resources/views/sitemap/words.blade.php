<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($words as $word)
        <url>
            <loc>https://codingdictionary.com/term/{{$word->word}}</loc>
            <lastmod>{{ $word->created_at->tz('GMT')->toAtomString() }}</lastmod>
        </url>
    @endforeach
</urlset>