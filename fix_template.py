import re
with open('storage/app/public/doc/Formulir/temp_template_extracted/word/document.xml', 'r', encoding='utf-8') as f:
    text = f.read()

# Replace all occurrences of <w:br w:type="page"/> with nothing
new_text = text.replace('<w:br w:type="page"/>', '')

with open('storage/app/public/doc/Formulir/temp_template_extracted/word/document.xml', 'w', encoding='utf-8') as f:
    f.write(new_text)

print("Page break removed.")
