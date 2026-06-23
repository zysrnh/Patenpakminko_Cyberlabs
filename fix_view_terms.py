import os
import glob

replacements = {
    "Jadwal Cek Lokasi": "Jadwal Peninjauan Lapangan",
    "Jadwal cek lokasi": "Jadwal peninjauan lapangan",
    "Cek lokasi": "Peninjauan lapangan",
    "cek lokasi": "peninjauan lapangan",
    "Cek Lokasi": "Peninjauan Lapangan",
}

views_dir = r"d:\Gawe\Patenpakminko_Cyberlabs\Patenpakminko\resources\views"
files = glob.glob(os.path.join(views_dir, "**/*.blade.php"), recursive=True)

for file in files:
    with open(file, 'r', encoding='utf-8') as f:
        content = f.read()

    new_content = content
    # We must be careful not to replace variable names like `bpn_cek_lokasi` or `cek_lokasi_ubah`.
    # Let's use regex to only replace when it's not part of a variable name (like `bpn_cek_lokasi`).
    # A simple way is to replace specific known phrases first.
    
    # Let's replace the specific phrases shown in the grep output.
    phrases = {
        "Jadwal Cek Lokasi": "Jadwal Peninjauan Lapangan",
        "Cek lokasi <strong>": "Peninjauan lapangan <strong>",
        "Waktu Cek Lokasi": "Waktu Peninjauan Lapangan",
        "Ubah Jadwal Cek Lokasi": "Ubah Jadwal Peninjauan Lapangan",
        "Simpan Jadwal Cek Lokasi": "Simpan Jadwal Peninjauan Lapangan",
        "Kirim Ulang Jadwal Cek Lokasi": "Kirim Ulang Jadwal Peninjauan Lapangan",
        "Cek lokasi terdaftar": "Peninjauan lapangan terdaftar",
        "Kirimkan Jadwal Cek Lokasi": "Kirimkan Jadwal Peninjauan Lapangan",
        "Penjadwalan cek lokasi": "Penjadwalan peninjauan lapangan",
        "Penjadwalan Cek Lokasi": "Penjadwalan Peninjauan Lapangan"
    }
    
    for old, new in phrases.items():
        new_content = new_content.replace(old, new)
        
    if new_content != content:
        with open(file, 'w', encoding='utf-8') as f:
            f.write(new_content)
        print(f"Updated {os.path.basename(file)}")

print("Done.")
