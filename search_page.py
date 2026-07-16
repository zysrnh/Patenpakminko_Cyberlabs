import re
with open('storage/app/public/doc/Formulir/temp_template_extracted/word/document.xml', 'r', encoding='utf-8') as f:
    text = f.read()
    matches = re.findall(r'<w:pgMar[^>]*>', text)
    print(matches)
