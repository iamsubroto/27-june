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
