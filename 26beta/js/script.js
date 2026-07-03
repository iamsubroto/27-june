/* ===================== TICKER ===================== */
(function(){
  var data=[
    {s:"SPY",p:612.40,c:0.62},{s:"AAPL",p:241.18,c:1.04},{s:"NVDA",p:178.90,c:2.31},
    {s:"MSFT",p:489.55,c:0.48},{s:"TSLA",p:402.77,c:-0.81},{s:"AMZN",p:233.10,c:0.93},
    {s:"META",p:718.20,c:1.42},{s:"QQQ",p:548.66,c:0.71},{s:"GOOGL",p:201.34,c:0.55},
    {s:"DIA",p:451.02,c:0.33},{s:"AMD",p:168.44,c:-0.42},{s:"NFLX",p:1024.7,c:1.18}
  ];
  function row(){
    return data.map(function(d){
      var cls=d.c>=0?"up":"down";var arr=d.c>=0?"▲":"▼";
      return "<b>"+d.s+"</b> "+d.p.toFixed(2)+" <span class='"+cls+"'>"+arr+Math.abs(d.c).toFixed(2)+"%</span>";
    }).join("\u2003\u2003");
  }
  var el=document.getElementById("tickerRow");
  el.innerHTML=row()+"\u2003\u2003"+row();
  var x=0;
  function tick(){
    x-=0.6;
    if(Math.abs(x)>=el.scrollWidth/2) x=0;
    el.style.transform="translateX("+x+"px)";
    requestAnimationFrame(tick);
  }
  requestAnimationFrame(tick);
})();

/* ===================== MOTOR DE VELAS (HERO + CTA) ===================== */
function candleEngine(canvasId, opts){
  opts=opts||{};
  var cv=document.getElementById(canvasId);
  if(!cv) return;
  var ctx=cv.getContext("2d");
  var W,H,dpr;
  var UP="#22c98a", UPedge="rgba(34,201,138,0.95)";
  var DOWN="#e0556b", DOWNedge="rgba(224,85,107,0.95)";
  var LINE="#3FD0F0";
  var maxC=opts.maxCandles||36;
  var basePrice=opts.base||5990;
  var nyseEl=opts.nyseEl||null, chgEl=opts.chgEl||null;
  var prevClose=basePrice;

  function resize(){
    dpr=window.devicePixelRatio||1;
    W=cv.clientWidth; H=cv.clientHeight;
    cv.width=W*dpr; cv.height=H*dpr;
    ctx.setTransform(dpr,0,0,dpr,0,0);
  }
  resize();
  window.addEventListener("resize",resize);

  var candles=[];
  var price=basePrice;
  function mk(open){
    var drift=(Math.random()-0.46)*(basePrice*0.009);
    var close=open+drift;
    var hi=Math.max(open,close)+Math.random()*(basePrice*0.005);
    var lo=Math.min(open,close)-Math.random()*(basePrice*0.005);
    return {o:open,c:close,h:hi,l:lo};
  }
  for(var i=0;i<maxC;i++){var c=mk(price);candles.push(c);price=c.c;}

  var partial,target,step;
  function newCandle(){partial={o:price,c:price,h:price,l:price};target=mk(price);step=0;}
  newCandle();

  var last=0;
  function draw(ts){
    if(!last) last=ts;
    if(ts-last>50){
      last=ts;
      step+=0.075;
      var t=Math.min(1,step);
      partial.c=price+(target.c-price)*t;
      partial.h=Math.max(partial.o,partial.c,price+(target.h-price)*t);
      partial.l=Math.min(partial.o,partial.c,price+(target.l-price)*t);
      if(step>=1){
        candles.push({o:partial.o,c:partial.c,h:partial.h,l:partial.l});
        if(candles.length>maxC) candles.shift();
        price=partial.c;
        newCandle();
      }
      if(nyseEl){
        nyseEl.textContent=partial.c.toLocaleString('en-US',{minimumFractionDigits:2,maximumFractionDigits:2});
        var diff=partial.c-prevClose;
        var pct=(diff/prevClose*100);
        var up=diff>=0;
        nyseEl.style.color= up?"#22c98a":"#e0556b";
        if(chgEl){
          chgEl.className= up?"up":"down";
          chgEl.style.color= up?"#22c98a":"#e0556b";
          chgEl.textContent=(up?"▲ +":"▼ ")+diff.toFixed(2)+" ("+(up?"+":"")+pct.toFixed(2)+"%)";
        }
      }
    }

    ctx.clearRect(0,0,W,H);
    var all=candles.concat([partial]);
    var hi=-Infinity,lo=Infinity;
    all.forEach(function(c){if(c.h>hi)hi=c.h;if(c.l<lo)lo=c.l;});
    var pad=(hi-lo)*0.16||4; hi+=pad; lo-=pad;
    var cw=W/maxC, bw=cw*0.56;
    function y(v){return H-((v-lo)/(hi-lo))*H;}
    var pts=[];
    for(var k=0;k<all.length;k++){
      var c=all[k], cx=(k+0.5)*cw, up=c.c>=c.o;
      ctx.strokeStyle=up?UPedge:DOWNedge; ctx.lineWidth=1;
      ctx.beginPath(); ctx.moveTo(cx,y(c.h)); ctx.lineTo(cx,y(c.l)); ctx.stroke();
      var yo=y(c.o), yc=y(c.c), top=Math.min(yo,yc), hgt=Math.max(2,Math.abs(yc-yo));
      ctx.fillStyle=up?UP:DOWN;
      ctx.globalAlpha=(k===all.length-1)?1:0.82;
      ctx.fillRect(cx-bw/2,top,bw,hgt);
      ctx.globalAlpha=1;
      pts.push([cx,y(c.c)]);
    }
    ctx.strokeStyle=LINE; ctx.lineWidth=1.7; ctx.globalAlpha=0.9;
    ctx.beginPath();
    pts.forEach(function(p,i){i===0?ctx.moveTo(p[0],p[1]):ctx.lineTo(p[0],p[1]);});
    ctx.stroke(); ctx.globalAlpha=1;
    var lp=pts[pts.length-1];
    if(lp){
      ctx.fillStyle=LINE;
      ctx.beginPath(); ctx.arc(lp[0],lp[1],3.2,0,7); ctx.fill();
      ctx.globalAlpha=0.22; ctx.beginPath(); ctx.arc(lp[0],lp[1],7,0,7); ctx.fill(); ctx.globalAlpha=1;
    }
    requestAnimationFrame(draw);
  }
  requestAnimationFrame(draw);
}
candleEngine("mktCanvas",{base:5990,maxCandles:38,nyseEl:document.getElementById("nysePrice"),chgEl:document.getElementById("nyseChg")});
candleEngine("ctaCanvas",{base:6020,maxCandles:30});

/* ===================== FAQ ACORDE&Oacute;N ===================== */
document.querySelectorAll(".qa button").forEach(function(b){
  b.addEventListener("click",function(){
    this.parentElement.classList.toggle("open");
  });
});

/* ===================== MOBILE NAV ===================== */
const burger = document.querySelector('.burger');
const navlinks = document.querySelector('.navlinks');

burger.addEventListener('click', () => {
  navlinks.classList.toggle('active');
  burger.classList.toggle('active');
  burger.textContent = navlinks.classList.contains('active') ? '\u2715' : '\u2630';
  document.body.style.overflow = navlinks.classList.contains('active') ? 'hidden' : '';
});

navlinks.querySelectorAll('a').forEach(link => {
  link.addEventListener('click', () => {
    navlinks.classList.remove('active');
    burger.classList.remove('active');
    burger.textContent = '\u2630';
    document.body.style.overflow = '';
  });
});


/* ============ DIAGNOSTIC POPUP JS ============ */
const DIAG = (function(){
  // ---- Definición del flujo ----
  const steps = [];

  // Paso 0: Registro (obligatorio)
  steps.push({type:'register'});

  // Preguntas (orden solicitado)
  const Q = [
    {kick:'Tu situación financiera', q:'¿Tienes orden en tus finanzas personales (presupuesto, control de gastos)?',
     opts:['Sí, llevo control','Más o menos','No, es un área que descuido']},
    {kick:'Tu situación financiera', q:'¿Tienes un fondo de emergencia (ahorro para imprevistos)?',
     opts:['Sí, de 3 meses o más','Algo, pero poco','No tengo']},
    {kick:'Tu experiencia con la inversión', q:'¿Cuál es tu experiencia invirtiendo en la Bolsa?',
     opts:['Nunca he invertido','Lo intenté pero no me funcionó','Invierto, pero sin consistencia']},
    {kick:'Tu experiencia con la inversión', q:'¿Qué tanto sabes de inversión en la Bolsa de Valores?',
     opts:['Nada o muy poco','Conceptos básicos','Tengo conocimiento sólido']},
    {kick:'Tu disposición', q:'¿Qué tan dispuesto estás a dedicar tiempo a aprender, con método y disciplina?',
     opts:['Muy dispuesto, es mi prioridad','Dispuesto, si me organizo','Tengo poco tiempo']},
    {kick:'Tu disposición', q:'¿Estás abierto a recibir acompañamiento y capacitación para lograrlo?',
     opts:['Sí, lo busco activamente','Tal vez, depende','Prefiero hacerlo solo']},
    {kick:'Tu disposición (filtro clave)', q:'¿Cuentas con recursos para invertir en ti y en la Bolsa de Valores?',
     opts:['Sí, cuento con capital disponible','Algo limitado, pero puedo empezar','Lo estoy reuniendo'], gate:true},
    {kick:'Tu confianza', q:'¿Cómo describirías tu confianza para tomar decisiones financieras hoy?',
     opts:['Me siento seguro','Inseguro, me falta guía','Me da miedo equivocarme']},
    {kick:'Tus metas y motivación', q:'¿Qué buscas lograr al aprender a invertir?',
     opts:['Generar ingresos extra','Asegurar mi retiro','Hacer crecer mis ahorros','Reinventarme profesionalmente']},
    {kick:'Tus metas y motivación', q:'¿Qué te motiva para invertir en la Bolsa?',
     opts:['Lograr libertad financiera','Construir mi propio retiro','Diversificar mis ingresos']},
  ];
  Q.forEach((qq,i)=>steps.push(Object.assign({type:'question',idx:i},qq)));

  // Paso simulador (aparece tras responder "Sí" a recursos)
  steps.push({type:'sim'});
  // Paso final
  steps.push({type:'done'});

  const state = {cur:0, answers:{}, reg:{}, amount:null, showSim:false};

  const overlay = ()=>document.getElementById('diagOverlay');
  const body = ()=>document.getElementById('diagBody');
  const prog = ()=>document.getElementById('diagProg');
  const stepTxt = ()=>document.getElementById('diagStep');

  function open(e){ if(e&&e.preventDefault)e.preventDefault(); state.cur=0; overlay().classList.add('open'); overlay().setAttribute('aria-hidden','false'); document.body.style.overflow='hidden'; render(); }
  function close(){ overlay().classList.remove('open'); overlay().setAttribute('aria-hidden','true'); document.body.style.overflow=''; }

  // total de pasos visibles para progreso (registro + 10 preguntas + sim + done)
  function totalVisible(){ return steps.length; }

  function setProgress(){
    const pct = Math.round((state.cur)/(totalVisible()-1)*100);
    prog().style.width = pct+'%';
    const s = steps[state.cur];
    let label='';
    if(s.type==='register') label='Registro';
    else if(s.type==='question') label='Pregunta '+(s.idx+1)+' de 10';
    else if(s.type==='sim') label='Tu escenario';
    else if(s.type==='done') label='Listo';
    stepTxt().textContent=label;
  }

  function render(){
    setProgress();
    const s = steps[state.cur];
    if(s.type==='register') return renderRegister();
    if(s.type==='question') return renderQuestion(s);
    if(s.type==='sim') return renderSim();
    if(s.type==='done') return renderDone();
  }

  function renderRegister(){
    body().innerHTML = `
      <div class="diagKick">Diagnóstico financiero gratuito</div>
      <div class="diagQ">Empecemos por Conocerte</div>
      <div class="diagHint">Responde con honestidad. En pocos minutos sabrás dónde estás y dónde están tus oportunidades.</div>
      <div class="diagField">
        <label>Nombre Completo <span class="req">*</span></label>
        <input id="rgName" type="text" placeholder="Tu Nombre" value="${state.reg.name||''}">
        <div class="diagErr" id="errName">Por favor escribe tu nombre.</div>
      </div>
      <div class="diagField">
        <label>Teléfono / WhatsApp <span class="req">*</span></label>
        <input id="rgPhone" type="tel" placeholder="Ej. 55 1234 5678" value="${state.reg.phone||''}">
        <div class="diagErr" id="errPhone">Escribe un teléfono válido.</div>
      </div>
      <div class="diagField">
        <label>Correo Electrónico <span class="req">*</span></label>
        <input id="rgMail" type="email" placeholder="tucorreo@ejemplo.com" value="${state.reg.mail||''}">
        <div class="diagErr" id="errMail">Escribe un correo válido.</div>
      </div>
      <div class="diagNav">
        <span></span>
        <button class="diagBtn next" onclick="DIAG.submitRegister()">Comenzar Diagnóstico →</button>
      </div>`;
  }

  function submitRegister(){
    const name=document.getElementById('rgName').value.trim();
    const phone=document.getElementById('rgPhone').value.trim();
    const mail=document.getElementById('rgMail').value.trim();
    let ok=true;
    const mailRe=/^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const phoneRe=/[0-9]{7,}/;
    document.getElementById('errName').classList.toggle('show', !name);
    document.getElementById('errPhone').classList.toggle('show', !phoneRe.test(phone.replace(/\s/g,'')));
    document.getElementById('errMail').classList.toggle('show', !mailRe.test(mail));
    if(!name||!phoneRe.test(phone.replace(/\s/g,''))||!mailRe.test(mail)) ok=false;
    if(!ok) return;
    state.reg={name,phone,mail};
    state.cur++; render();
  }

  function renderQuestion(s){
    const sel = state.answers[s.idx];
    let optsHtml = s.opts.map((o,i)=>`
      <button class="diagOpt ${sel===i?'sel':''}" onclick="DIAG.pick(${s.idx},${i})">
        <span class="dot">${sel===i?'✓':''}</span><span>${o}</span>
      </button>`).join('');
    body().innerHTML = `
      <div class="diagKick">${s.kick}</div>
      <div class="diagQ">${s.q}</div>
      <div class="diagOpts">${optsHtml}</div>
      <div class="diagNav">
        <button class="diagBtn back" onclick="DIAG.prev()">← Atrás</button>
        <button class="diagBtn next" id="qNext" ${sel===undefined?'disabled':''} onclick="DIAG.nextFromQuestion()">Siguiente →</button>
      </div>`;
  }

  function pick(idx,opt){
    state.answers[idx]=opt;
    // si es la pregunta gate (recursos) y elige "Sí" (opción 0), activar simulador
    const s = steps.find(st=>st.type==='question'&&st.idx===idx);
    render();
  }

  function nextFromQuestion(){
    const s = steps[state.cur];
    // Si es la pregunta gate y respondió "Sí, cuento con capital" (índice 0) o "Algo limitado" (1) -> mostrar simulador
    if(s.gate){
      const ans = state.answers[s.idx];
      state.showSim = (ans===0 || ans===1); // si tiene o puede empezar, mostramos escenario
    }
    advance();
  }

  function advance(){
    // saltar el paso 'sim' si no corresponde
    let next = state.cur+1;
    while(next<steps.length && steps[next].type==='sim' && !state.showSim){ next++; }
    state.cur=next; render();
  }
  function prev(){
    let p = state.cur-1;
    while(p>0 && steps[p].type==='sim' && !state.showSim){ p--; }
    state.cur=Math.max(0,p); render();
  }

  // ---- Simulador de rentabilidades ----
  function renderSim(){
    const amt = state.amount || 100;
    body().innerHTML = `
      <div class="diagKick">Tu punto de partida</div>
      <div class="diagQ">¿Con cuánto estarías dispuesto a comenzar?</div>
      <div class="diagHint">Elige un monto y mira un escenario estimado de lo que el entrenamiento y el Método CERO buscan construir contigo.</div>
      <div class="amtOpts">
        <div class="amtOpt ${amt===50?'sel':''}" onclick="DIAG.setAmt(50)"><span class="amt">$50</span><span class="amtl">USD</span></div>
        <div class="amtOpt ${amt===100?'sel':''}" onclick="DIAG.setAmt(100)"><span class="amt">$100</span><span class="amtl">USD</span></div>
        <div class="amtOpt ${amt===500?'sel':''}" onclick="DIAG.setAmt(500)"><span class="amt">$500</span><span class="amtl">USD</span></div>
      </div>
      <div id="simResult"></div>
      <div class="diagNav">
        <button class="diagBtn back" onclick="DIAG.prev()">← Atrás</button>
        <button class="diagBtn next" onclick="DIAG.toDone()">Procesar diagnóstico →</button>
      </div>`;
    drawSim();
  }

  function setAmt(a){ state.amount=a; document.querySelectorAll('.amtOpt').forEach(e=>e.classList.remove('sel')); event.currentTarget.classList.add('sel'); drawSim(); }

  function drawSim(){
    const cap = state.amount || 100;
    // ACCIONES: escenario realista compuesto. Aporte mensual = mismo monto. Tasa efectiva ~3%/mes (5% en 60% de meses).
    const aporte = cap;
    const rEff = 0.03; // mensual efectivo realista
    function fvStocks(months){
      return cap*Math.pow(1+rEff,months) + aporte*((Math.pow(1+rEff,months)-1)/rEff);
    }
    const acc1 = fvStocks(12), acc3 = fvStocks(36);
    const aportado3 = cap + aporte*36;
    // OPCIONES: ejemplo destacado (sin componer). Mostramos el rango "veces la inversión" con casos reales.
    // Usamos un caso medio como referencia: si una operación logra +100% duplica; casos altos multiplican varias veces.
    const opcDup = cap*2;      // duplicar (100%)
    const opcAlta = cap*4.1;   // referencia MSFT 311% -> 4.1x

    document.getElementById('simResult').innerHTML = `
      <div class="simWrap">
        <div class="simRow">
          <div class="simCard">
            <h4>📈 ACCIONES · método</h4>
            <div class="big">$${Math.round(acc3).toLocaleString('en-US')}</div>
            <div class="sub">Escenario realista a 3 años, aportando $${cap}/mes y reinvirtiendo. Pones $${Math.round(aportado3).toLocaleString('en-US')}.</div>
          </div>
          <div class="simCard opc">
            <h4>⚡ OPCIONES · método</h4>
            <div class="big">$${Math.round(opcDup).toLocaleString('en-US')} – $${Math.round(opcAlta).toLocaleString('en-US')}+</div>
            <div class="sub">Rango por operación destacada: de duplicar (2x) a multiplicar varias veces tu capital. Puede darse en minutos, horas, días o semanas. Variable.</div>
          </div>
        </div>
        <div class="simNote">
          <p>⚠ Esto NO es una garantía ni una promesa de ganancias. Son escenarios estimados con fines ilustrativos. Los resultados dependen de seguir el Método CERO, del entrenamiento y la disciplina de cada persona. Invertir conlleva riesgo y los resultados pasados no garantizan resultados futuros.</p>
        </div>
      </div>`;
  }

  function toDone(){ if(!state.amount) state.amount=100; state.cur=steps.length-1; render(); }

  function renderDone(){
    body().innerHTML = `
      <div class="diagDone">
        <div class="check">✓</div>
        <h3>¡Diagnóstico recibido!</h3>
        <p>Gracias, ${state.reg.name? state.reg.name.split(' ')[0] : ''}. En breve nuestro equipo te contactará para darte el resultado de tu diagnóstico y, si calificas, los detalles de tu beca.</p>
        <p class="small">Revisa tu WhatsApp y tu correo. ¡Diste el primer paso! 🚀</p>
        <div class="diagNav" style="justify-content:center;margin-top:26px;">
          <button class="diagBtn next" onclick="DIAG.close()">Cerrar</button>
        </div>
      </div>`;
    // Progreso completo
    prog().style.width='100%';
  }

  return {open,close,submitRegister,pick,nextFromQuestion,prev,setAmt,toDone,_state:state};
})();
