import os
import glob

replacements = {
    "'TANAH TIMBUL'": "'Pertimbangan Teknis Pertanahan Tanah Timbul'",
    "'Proyek Strategis Nasional'": "'Pertimbangan Teknis Pertanahan Proyek Strategis Nasional (PSN)'",
    "'PPKPR Non Berusaha'": "'Pertimbangan Teknis Pertanahan PKKPR Non Berusaha'",
    "'PPKPR Berusaha'": "'Pertimbangan Teknis Pertanahan PKKPR Berusaha'",
    "'Kebijakan'": "'Pertimbangan Teknis Pertanahan Kebijakan'"
}

controllers_dir = r"d:\Gawe\Patenpakminko_Cyberlabs\Patenpakminko\app\Http\Controllers"
files = glob.glob(os.path.join(controllers_dir, "*.php"))

for file in files:
    with open(file, 'r', encoding='utf-8') as f:
        content = f.read()

    new_content = content
    for old, new in replacements.items():
        # Only replace inside sendNotificationWithMailbox
        # To be safe, we can just replace the string if it's matched with sendNotificationWithMailbox.
        # Let's do a simple replace since those strings are mostly unique in those controllers anyway,
        # but to be extremely safe, we'll split by sendNotificationWithMailbox and replace in that line.
        
        lines = new_content.split('\n')
        for i, line in enumerate(lines):
            if 'sendNotificationWithMailbox' in line:
                lines[i] = line.replace(old, new)
        new_content = '\n'.join(lines)

    if new_content != content:
        with open(file, 'w', encoding='utf-8') as f:
            f.write(new_content)
        print(f"Updated {os.path.basename(file)}")

print("Done.")
