<?php 
echo '<?';?>xml version="1.0" encoding="UTF-8"?>
<urlset
      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
<url>
  <loc><?php echo $this->createAbsoluteUrl('/');?></loc>
  <changefreq>Weekly</changefreq>
  <priority>1.00</priority>
</url>
<url>
  <loc><?php echo $this->createAbsoluteUrl('about');?></loc>
  <changefreq>Yearly</changefreq>
  <priority>0.80</priority>
</url>
<url>
  <loc><?php echo $this->createAbsoluteUrl('contact');?></loc>
  <changefreq>Yearly</changefreq>
  <priority>0.80</priority>
</url>
<url>
  <loc><?php echo $this->createAbsoluteUrl('/ads/create');?></loc>
  <changefreq>Never</changefreq>
  <priority>0.80</priority>
</url>
<url>
  <loc><?php echo $this->createAbsoluteUrl('login');?></loc>
  <changefreq>Never</changefreq>
  <priority>0.80</priority>
</url>
<url>
  <loc><?php echo $this->createAbsoluteUrl('register');?></loc>
  <changefreq>Never</changefreq>
  <priority>0.80</priority>
</url>
<?php 
foreach ($category as $value) {
  echo '<url>
  <loc>'.$this->createAbsoluteUrl('/ads/searchAll',array('catId' => $value->id)).'</loc>
  <changefreq>Daily</changefreq>
  <priority>0.80</priority>
</url>
';
}
foreach ($ads as $value) {
  echo '<url>
  <loc>'.$this->createAbsoluteUrl('/ads/view',array('id' => $value->id)).'</loc>
  <changefreq>Monthly</changefreq>
  <priority>0.80</priority>
</url>
';
}

?>
</urlset>