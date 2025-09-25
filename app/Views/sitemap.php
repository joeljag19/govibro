<?= '<?xml version="1.0" encoding="UTF-8" ?>' ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc><?= site_url() ?></loc>
        <lastmod><?= date('Y-m-d\TH:i:sP') ?></lastmod>
        <priority>1.0</priority>
    </url>

    <?php if (!empty($tours)): ?>
        <?php foreach ($tours as $tour): ?>
        <url>
            <loc><?= site_url('tours/' . $tour['slug']) ?></loc>
            <lastmod><?= date('Y-m-d\TH:i:sP', strtotime($tour['updated_at'])) ?></lastmod>
            <priority>0.8</priority>
        </url>
        <?php endforeach; ?>
    <?php endif; ?>

    </urlset>