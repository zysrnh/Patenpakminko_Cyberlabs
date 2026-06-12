<?php
$file = "resources/views/kebijakan/show.blade.php";
$content = file_get_contents($file);

// First try to just replace the known mojibake strings manually.
// Let's print out the content to see what it actually looks like in UTF8.
$content = mb_convert_encoding(mb_convert_encoding($content, 'ISO-8859-1', 'UTF-8'), 'ISO-8859-1', 'UTF-8');
// wait, we can just replace what the browser renders!
$map = [
    "ÃƒÂ¢Ã‚ÂÃ‚Â³" => "⏳",
    "ÃƒÂ¢Ã¢â€šÂ¬Ã¢â‚¬Å“" => "—",
    "ÃƒÂ¢Ã¢â€šÂ¬Ã‚Â¢" => "•",
    "ÃƒÂ¢Ã¢â€šÂ¬Ã‚Â¦" => "✏️",
    "Ã¢â‚¬â€ " => "—",
    "Ã¢Å¡Â Ã¯Â¸Â " => "⚠️",
    "Ã¢Å“â€¦" => "✅",
    "Ã¢Å“ÂÃ¯Â¸Â " => "✏️",
    "Ã¢Å“Â…" => "✅",
    "Ã¢Å“ÂÃ¯Â¸Â " => "✏️",
    "Ã¢Å¾Â¡Ã¯Â¸Â " => "➡️",
    "Ã¢â€žÂ¹Ã¯Â¸Â " => "ℹ️",
    "Ã¢ÂÂ³" => "⏳",
    "Ã¢Ëœâ€ " => "⭐",
    "Ã¢Ëœâ€¦" => "⭐",
    "Ã°Å¸â€™Â°" => "💰",
    "Ã°Å¸â€œâ€ž" => "📄",
    "Ã°Å¸â€œÂ" => "📝",
    "Ã°Å¸â€œÂ" => "📁",
    "Ã°Å¸â€œÂ‚" => "📂",
    "Ã°Å¸â€œÂ£" => "📣",
    "Ã°Å¸â€œÂ" => "📍",
    "Ã°Å¸â€œÂŒ" => "📌",
    "Ã°Å¸Å¡Â€" => "🚀",
    "Ã°Å¸â€â€ž" => "🔄",
    "Ã°Å¸â€â€š" => "🔂",
    "Ã°Å¸ÂÂ¢" => "🏢",
    "Ã°Å¸Ââ€º" => "🏛️",
    "Ã¢â‚¬" => "—",
    "ǟ<" => "⭐",
    "ǟǽ?sǽ'? " => "— ",
    "ǟǽ'?sǽ'? " => "— ",
    "ǟǽ'?ǽ?s " => "— ",
    "ǟ'? " => "⏳ ",
    "ǟ." => "✅",
    "ǟ?s'" => "—",
    "ǟ.ǽ'?'" => "✏️",
    "ǟ.?o''?ǟ''?" => "✏️",
    "ǟ.'ǟ''?" => "⚠️",
    "ǟ..?o'" => "❌",
    "ǟ..'" => "❌"
];

foreach ($map as $bad => $good) {
    $content = str_replace($bad, $good, $content);
}

// We can also try utf8_decode if the exact double encoding is present.
$lines = explode("\n", $content);
foreach ($lines as &$line) {
    if (strpos($line, 'Ã') !== false || strpos($line, 'ǟ') !== false) {
        $decoded = utf8_decode($line);
        if (strpos($decoded, '—') !== false || strpos($decoded, '⏳') !== false || strpos($decoded, '⚠️') !== false) {
             $line = $decoded;
        }
        $decoded2 = utf8_decode($decoded);
        if (strpos($decoded2, '—') !== false || strpos($decoded2, '⏳') !== false || strpos($decoded2, '⚠️') !== false) {
             $line = $decoded2;
        }
    }
}
$content = implode("\n", $lines);

file_put_contents($file, $content);
echo "Done replacing map.";
