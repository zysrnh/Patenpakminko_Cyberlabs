import os

files = [
    r'd:\Gawe\Patenpakminko_Cyberlabs\Patenpakminko\resources\views\berusaha\show.blade.php',
    r'd:\Gawe\Patenpakminko_Cyberlabs\Patenpakminko\resources\views\non-berusaha\show.blade.php',
    r'd:\Gawe\Patenpakminko_Cyberlabs\Patenpakminko\resources\views\kebijakan\show.blade.php',
    r'd:\Gawe\Patenpakminko_Cyberlabs\Patenpakminko\resources\views\tanah-timbul\show.blade.php',
    r'd:\Gawe\Patenpakminko_Cyberlabs\Patenpakminko\resources\views\psn\show.blade.php'
]

new_block = """<!-- TIMELINE UX ENHANCEMENTS -->
<style>
    .timeline-step.viewing-step {
        background: #F0F9FF;
        border-radius: 8px;
        padding-left: 8px;
        margin-left: -8px;
        outline: 1px solid #BAE6FD;
        transition: all 0.3s ease;
    }
    .timeline-step.viewing-step .timeline-title {
        color: #0369A1;
    }
    .timeline-step.viewing-step .timeline-title::after {
        content: "👀 Sedang Dilihat";
        display: inline-block;
        background: #0EA5E9;
        color: white;
        font-size: 10px;
        font-weight: 800;
        padding: 2px 8px;
        border-radius: 12px;
        margin-left: 8px;
        vertical-align: middle;
        letter-spacing: 0.5px;
        box-shadow: 0 2px 4px rgba(14,165,233,0.3);
    }
    .panel-nav-buttons {
        display: flex;
        justify-content: space-between;
        margin-top: 24px;
        padding-top: 16px;
        border-top: 1px solid #E2E8F0;
    }
    .btn-nav-panel {
        padding: 8px 16px;
        font-size: 13px;
        font-weight: 600;
        border-radius: 6px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        border: 1px solid #CBD5E1;
        background: #F8FAFC;
        color: #475569;
        transition: all 0.2s;
    }
    .btn-nav-panel:hover {
        background: #F1F5F9;
        color: #0F172A;
        border-color: #94A3B8;
    }
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const timelineSteps = Array.from(document.querySelectorAll('.timeline-step[onclick^="showBpnPanel"]'));
    
    // Inject Nav Buttons to each Panel
    timelineSteps.forEach((step, index) => {
        const onclickAttr = step.getAttribute('onclick');
        const match = onclickAttr.match(/showBpnPanel\\(['"]?([^'"]+)['"]?\\)/);
        if(!match) return;
        const panelId = 'bpn-panel-' + match[1];
        const panel = document.getElementById(panelId);
        
        if(panel) {
            panel.dataset.stepIndex = index;
            step.dataset.stepIndex = index;
            
            step.addEventListener('click', function() {
                document.querySelectorAll('.timeline-step').forEach(ts => ts.classList.remove('viewing-step'));
                step.classList.add('viewing-step');
                
                // Also hide other panels to be safe
                document.querySelectorAll('.bpn-panel-step').forEach(p => p.style.display = 'none');
                panel.style.display = 'block';
            });
            
            const navDiv = document.createElement('div');
            navDiv.className = 'panel-nav-buttons';
            
            const prevBtn = document.createElement('button');
            prevBtn.type = 'button';
            prevBtn.className = 'btn-nav-panel';
            prevBtn.innerHTML = '<svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg> Sebelumnya';
            if(index === 0) {
                prevBtn.style.visibility = 'hidden';
            } else {
                prevBtn.onclick = function(e) {
                    e.preventDefault();
                    timelineSteps[index - 1].click();
                };
            }
            
            const nextBtn = document.createElement('button');
            nextBtn.type = 'button';
            nextBtn.className = 'btn-nav-panel';
            nextBtn.innerHTML = 'Selanjutnya <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>';
            if(index === timelineSteps.length - 1) {
                nextBtn.style.visibility = 'hidden';
            } else {
                nextBtn.onclick = function(e) {
                    e.preventDefault();
                    timelineSteps[index + 1].click();
                };
            }
            
            navDiv.appendChild(prevBtn);
            navDiv.appendChild(nextBtn);
            
            if(!panel.querySelector('.panel-nav-buttons')) {
                panel.appendChild(navDiv);
            }
        }
    });
    
    setTimeout(() => {
        const activePanel = document.querySelector('.bpn-panel-step[style*="display: block"]');
        if(activePanel && activePanel.dataset.stepIndex) {
            timelineSteps[activePanel.dataset.stepIndex].classList.add('viewing-step');
        } else if (timelineSteps.length > 0) {
            // Fallback if none are block
            let found = false;
            document.querySelectorAll('.bpn-panel-step').forEach((p, idx) => {
                if(p.style.display !== 'none' && timelineSteps[idx]) {
                    timelineSteps[idx].classList.add('viewing-step');
                    found = true;
                }
            });
        }
    }, 150);
});
</script>
</body>
</html>"""

for file in files:
    if os.path.exists(file):
        with open(file, 'r', encoding='utf-8') as f:
            content = f.read()
            
        if '<!-- TIMELINE UX ENHANCEMENTS -->' in content:
            content = content.split('<!-- TIMELINE UX ENHANCEMENTS -->')[0] + new_block
            with open(file, 'w', encoding='utf-8') as f:
                f.write(content)
            print('Updated ' + file)
