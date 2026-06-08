import zipfile
import xml.etree.ElementTree as ET
import sys

def extract_text_from_docx(docx_path):
    text = []
    with zipfile.ZipFile(docx_path) as docx:
        xml_content = docx.read('word/document.xml')
        tree = ET.fromstring(xml_content)
        
        # Namespaces
        namespaces = {'w': 'http://schemas.openxmlformats.org/wordprocessingml/2006/main'}
        
        for paragraph in tree.findall('.//w:p', namespaces):
            para_text = []
            for run in paragraph.findall('.//w:r', namespaces):
                t_elem = run.find('w:t', namespaces)
                if t_elem is not None and t_elem.text:
                    para_text.append(t_elem.text)
            text.append(''.join(para_text))
            
    return '\n'.join(text)

print(extract_text_from_docx(sys.argv[1]))
