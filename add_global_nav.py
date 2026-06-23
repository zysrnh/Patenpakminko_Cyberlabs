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
        content: "📍";
        display: inline-block;
        font-size: 14px;
        margin-left: 6px;
        vertical-align: middle;
        animation: pin-bounce 1s infinite;
    }
    @keyframes pin-bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-3px); }
    }
    .global-nav-buttons {
        display: flex;
        justify-content: space-between;
        padding: 12px 16px;
        background: #F8FAFC;
        border-top: 1px solid #E2E8F0;
        border-bottom-left-radius: 12px;
        border-bottom-right-radius: 12px;
        position: sticky;
        bottom: 0;
        z-index: 10;
    }
    .btn-nav-global {
        padding: 6px 14px;
        font-size: 12px;
        font-weight: 600;
        border-radius: 6px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        border: 1px solid #CBD5E1;
        background: #FFFFFF;
        color: #475569;
        transition: all 0.2s;
        box-shadow: 0 1px 2px rgba(0,0,0,0.05);
    }
    .btn-nav-global:hover:not(:disabled) {
        background: #F1F5F9;
        color: #0F172A;
        border-color: #94A3B8;
    }
    .btn-nav-global:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const timelineSteps = Array.from(document.querySelectorAll('.timeline-step[onclick^="showBpnPanel"]'));
    if(timelineSteps.length === 0) return;
    
    let currentIndex = 0;
    
    // Create Global Nav Container
    const navDiv = document.createElement('div');
    navDiv.className = 'global-nav-buttons';
    
    const prevBtn = document.createElement('button');
    prevBtn.type = 'button';
    prevBtn.className = 'btn-nav-global';
    prevBtn.innerHTML = '<svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg> Sebelumnya';
    
    const nextBtn = document.createElement('button');
    nextBtn.type = 'button';
    nextBtn.className = 'btn-nav-global';
    nextBtn.innerHTML = 'Selanjutnya <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>';
    
    navDiv.appendChild(prevBtn);
    navDiv.appendChild(nextBtn);
    
    // Find the timeline container (the card that holds timeline-body)
    const timelineBody = document.querySelector('.timeline-body');
    if(timelineBody) {
        const card = timelineBody.closest('.card');
        if(card) {
            // Append to the bottom of the card
            card.appendChild(navDiv);
        }
    }
    
    function updateNavButtons() {
        prevBtn.disabled = currentIndex === 0;
        nextBtn.disabled = currentIndex === timelineSteps.length - 1;
    }
    
    function switchPanel(index) {
        if(index < 0 || index >= timelineSteps.length) return;
        
        currentIndex = index;
        const targetStep = timelineSteps[currentIndex];
        const match = targetStep.getAttribute('onclick').match(/showBpnPanel\\(['"]?([^'"]+)['"]?\\)/);
        
        if(match) {
            const tPanel = document.getElementById('bpn-panel-' + match[1]);
            document.querySelectorAll('.bpn-panel-step').forEach(p => p.style.display = 'none');
            if(tPanel) { 
                tPanel.style.display = 'block'; 
                // Only scroll left side if mobile, on desktop timeline is sticky so it doesn't matter, but let's scroll the window slightly if needed
                // tPanel.scrollIntoView({ behavior: 'smooth', block: 'center' }); 
            }
            
            document.querySelectorAll('.timeline-step').forEach(ts => ts.classList.remove('viewing-step'));
            targetStep.classList.add('viewing-step');
            
            // Auto scroll timeline itself so the active step is visible
            targetStep.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }
        updateNavButtons();
    }
    
    // Override click on timeline steps to sync currentIndex
    timelineSteps.forEach((step, index) => {
        step.addEventListener('click', function(e) {
            e.preventDefault(); // prevent inline execution if we are overriding
            switchPanel(index);
        });
    });
    
    prevBtn.addEventListener('click', () => switchPanel(currentIndex - 1));
    nextBtn.addEventListener('click', () => switchPanel(currentIndex + 1));
    
    // Initialize
    setTimeout(() => {
        const activePanel = document.querySelector('.bpn-panel-step[style*="display: block"]');
        if(activePanel) {
            const panelIdMatch = activePanel.id.replace('bpn-panel-', '');
            const activeStepIndex = timelineSteps.findIndex(s => s.getAttribute('onclick').includes(panelIdMatch));
            if(activeStepIndex !== -1) {
                switchPanel(activeStepIndex);
            } else {
                switchPanel(0);
            }
        } else {
            switchPanel(0);
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
