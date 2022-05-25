<?php
include('bootstra.php');
 header( "Content-type: text/xml");
echo "<rss version='2.0' xmlns:atom='http://www.w3.org/2005/Atom'>\n";
echo "<channel>\n";

echo "<title>Demo RSS Feed</title>\n";
echo "<description>RSS Description</description>\n";
echo "<link>http://www.aslo.tech</link>\n";

$sql = "SELECT 
			d.name as newTitle,
			d.date_available as newDate,
			c.content_body as newFile
		FROM
			desktop as d,
			document_contents as c
		WHERE
			c.doc_id = d.desktop_id
			AND
			d.material_icon = 'headphones'
			";
$que = $db->prepare($sql);
try { 
	$que->execute();
	while($row = $que->fetch(PDO::FETCH_ASSOC))
	{
	echo "<item>\n";
    echo "<title>{$row['newTitle']}</title>\n";
    echo "<description></description>\n";
    echo "<pubDate>".date('D, d M Y H:i:s',strtotime($row['newDate']))." GMT</pubDate>\n";
	echo '<enclosure url="http://www.aslo.tech/wfh/documents/audio/'.$row['newFile'].'" length="FILE SIZE IN BYTES" type="FOR AN MP3 FILE - audio/mpeg" />\n';
    echo "<link>http://www.aslo.tech/wfh/documents/audio/{$row['newFile']}</link>\n";
    echo "<guid>http://www.aslo.tech/</guid>\n";
    echo "<atom:link href='http://www.aslo.tech/' rel='self' type='application/rss+xml'/>\n";
echo "</item>\n";
	}
}catch(PDOException $e) { die($e->getMessage());}
echo "</channel>\n";
echo "</rss>\n";