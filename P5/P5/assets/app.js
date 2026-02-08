(function(){
  const dd = document.getElementById('dd');
  const btn = document.getElementById('ddBtn');
  if(dd && btn){
    function closeDD(){ dd.classList.remove('open'); btn.setAttribute('aria-expanded','false'); }
    function toggleDD(){
      const isOpen = dd.classList.toggle('open');
      btn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    }
    btn.addEventListener('click', (e)=>{ e.stopPropagation(); toggleDD(); });
    document.addEventListener('click', ()=> closeDD());
    document.addEventListener('keydown', (e)=>{ if(e.key === 'Escape') closeDD(); });
  }

  // Auto-close flash messages
  const flash = document.querySelector('.flash');
  if(flash){
    setTimeout(()=> flash.style.display='none', 4500);
  }
})();
