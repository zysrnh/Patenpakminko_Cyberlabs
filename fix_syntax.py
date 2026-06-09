import os

for c in ['KebijakanController.php', 'TanahTimbulController.php']:
    p = 'app/Http/Controllers/' + c
    with open(p, 'r', encoding='utf-8') as f: txt = f.read()
    
    # Extract Satu Pintu block
    satu_pintu_start = txt.find('        // SATU PINTU Langkah 6: Upload Sertifikat Akhir (Dinas PMPTSP)')
    if satu_pintu_start != -1:
        # Find the end of the block (the closing brace before the class closing brace)
        # We can just extract everything from satu_pintu_start up to the very last '}'
        satu_pintu_block = txt[satu_pintu_start:txt.rfind('}', 0, txt.rfind('}')) + 1]
        
        # Remove from end
        txt = txt[:satu_pintu_start] + '\n}'
        
        # Insert inside verify() just before abort(403)
        abort_idx = txt.find("        abort(403, 'Aksi tidak diizinkan atau status permohonan tidak sesuai.');")
        if abort_idx != -1:
            txt = txt[:abort_idx] + satu_pintu_block + '\n\n' + txt[abort_idx:]
            with open(p, 'w', encoding='utf-8') as f: f.write(txt)
            print(f'Fixed Syntax in {c}')
