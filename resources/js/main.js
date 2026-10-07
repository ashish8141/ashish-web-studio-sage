/**
 * Ashish Web Studio — front-end motion.
 * Reading progress, spring-timed staggered reveals, active TOC,
 * count-up stats, 3D-tilt work cards, magnetic buttons, share buttons.
 */
(function () {
  'use strict';
  var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  function ready(fn) {
    if (document.readyState !== 'loading') fn();
    else document.addEventListener('DOMContentLoaded', fn);
  }

  ready(function () {
    var bar = document.getElementById('aws-progress');
    var article = document.getElementById('aws-article');
    var toc = document.getElementById('aws-toc');

    function onScroll() {
      if (bar) {
        var h = document.documentElement.scrollHeight - window.innerHeight;
        bar.style.width = (h > 0 ? (window.scrollY / h) * 100 : 0) + '%';
      }
      if (article && toc) {
        var heads = article.querySelectorAll('h2[id]');
        var current = null;
        heads.forEach(function (h2) { if (h2.getBoundingClientRect().top < 140) current = h2.id; });
        toc.querySelectorAll('[data-toc]').forEach(function (a) {
          a.classList.toggle('is-active', a.getAttribute('data-toc') === current);
        });
      }
    }
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();

    // ---- staggered reveal ----
    var spring = 'cubic-bezier(.16,1,.3,1)';
    if (!window.AWS_FX) document.querySelectorAll('[data-reveal]').forEach(function (block) {
      var items = [];
      Array.prototype.forEach.call(block.children, function (child) {
        var kids = child.children;
        var disp = getComputedStyle(child).display;
        var isRow = kids.length > 1 && (disp.indexOf('grid') > -1 || disp.indexOf('flex') > -1);
        if (isRow) items.push.apply(items, kids); else items.push(child);
      });
      if (!items.length) items = [block];
      if (reduce) return;
      items.forEach(function (n) {
        n.style.opacity = '0';
        n.style.transform = 'translateY(24px)';
        
        n.style.willChange = 'opacity, transform';
      });
      var fired = 0;
      var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (e) {
          if (!e.isIntersecting) return;
          io.unobserve(e.target);
          var delay = Math.min(fired * 85, 600);
          fired++;
          e.target.style.transition = 'opacity .8s ' + spring + ' ' + delay + 'ms, transform .9s ' + spring + ' ' + delay + 'ms';
          requestAnimationFrame(function () {
            e.target.style.opacity = '1';
            e.target.style.transform = 'none';
            
            setTimeout(function () { e.target.style.willChange = 'auto'; }, 1100 + delay);
          });
        });
      }, { threshold: 0.14, rootMargin: '0px 0px -8% 0px' });
      items.forEach(function (n) { io.observe(n); });
    });

    // ---- count-up stats ----
    var counters = document.querySelectorAll('[data-count]');
    if (counters.length) {
      var cio = new IntersectionObserver(function (ents) {
        ents.forEach(function (e) {
          if (!e.isIntersecting) return;
          cio.unobserve(e.target);
          var el = e.target;
          var target = parseFloat(el.getAttribute('data-count'));
          var suffix = el.getAttribute('data-suffix') || '';
          var t0 = performance.now();
          (function tick(t) {
            var p = Math.min((t - t0) / 1100, 1);
            el.textContent = Math.round(target * (1 - Math.pow(1 - p, 3))) + suffix;
            if (p < 1) requestAnimationFrame(tick);
          })(t0);
        });
      }, { threshold: 0.6 });
      counters.forEach(function (c) { cio.observe(c); });
    }

    // ---- share buttons ----
    document.querySelectorAll('[data-share-group]').forEach(function (group) {
      group.querySelectorAll('[data-share]').forEach(function (btn) {
        btn.addEventListener('click', function () {
          var kind = btn.getAttribute('data-share');
          var url = location.href;
          if (kind === 'copy') {
            if (navigator.clipboard) navigator.clipboard.writeText(url);
            var t = btn.textContent; btn.textContent = '✓';
            setTimeout(function () { btn.textContent = t; }, 1200);
          } else if (kind === 'twitter') {
            window.open('https://twitter.com/intent/tweet?url=' + encodeURIComponent(url), '_blank', 'noopener');
          } else {
            window.open('https://www.linkedin.com/sharing/share-offsite/?url=' + encodeURIComponent(url), '_blank', 'noopener');
          }
        });
      });
    });

    // ---- mobile hamburger flyout ----
    var burger = document.querySelector('.aws-burger');
    var flyout = document.getElementById('aws-flyout');
    if (burger && flyout) {
      var setOpen = function (open) {
        document.body.classList.toggle('aws-nav-open', open);
        burger.setAttribute('aria-expanded', open ? 'true' : 'false');
        flyout.setAttribute('aria-hidden', open ? 'false' : 'true');
      };
      burger.addEventListener('click', function () {
        setOpen(!document.body.classList.contains('aws-nav-open'));
      });
      flyout.querySelectorAll('.aws-sub-toggle').forEach(function (t) {
        var sub = document.getElementById(t.getAttribute('aria-controls'));
        if (!sub) return;
        t.addEventListener('click', function () {
          var open = t.getAttribute('aria-expanded') !== 'true';
          t.setAttribute('aria-expanded', open ? 'true' : 'false');
          sub.hidden = !open;
        });
      });
      flyout.querySelectorAll('a').forEach(function (a) {
        a.addEventListener('click', function () { setOpen(false); });
      });
      var closeBtn = flyout.querySelector('.aws-flyout-close');
      if (closeBtn) closeBtn.addEventListener('click', function () { setOpen(false); });
      document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') setOpen(false);
      });
    }

    // ---- marquee pause handled by CSS :hover ----
  });
})();


// ---- inline newsletter subscribe (Mailchimp JSONP, no redirect) ----
(function(){
  var forms = document.querySelectorAll('[data-news-form]');
  if (!forms.length) return;
  var n = 0;
  forms.forEach(function (form) {
    var msg = form.parentNode.querySelector('[data-news-msg]');
    var btn = form.querySelector('button[type="submit"]');
    function say(text, ok) {
      if (!msg) return;
      msg.textContent = text;
      msg.style.color = ok ? '#f7f6f3' : '#ffb4a2';
      msg.style.opacity = '1';
    }
    form.addEventListener('submit', function (ev) {
      ev.preventDefault();
      var email = (form.querySelector('input[name="EMAIL"]') || {}).value || '';
      if (!email || email.indexOf('@') < 1) { say('Please enter a valid email address.', false); return; }
      var label = btn ? btn.textContent : '';
      if (btn) { btn.disabled = true; btn.textContent = 'sending...'; }
      var cb = 'awsNews' + (++n) + '_' + Date.now();
      var url = form.getAttribute('action').replace('/post?', '/post-json?')
        + '&c=' + cb
        + '&EMAIL=' + encodeURIComponent(email)
        + '&FNAME=' + encodeURIComponent((form.querySelector('input[name="FNAME"]') || {}).value || '')
        + '&LNAME=' + encodeURIComponent((form.querySelector('input[name="LNAME"]') || {}).value || '');
      var s = document.createElement('script');
      var done = false;
      function finish(text, ok) {
        if (done) return; done = true;
        say(text, ok);
        if (btn) { btn.disabled = false; btn.textContent = label; }
        if (ok) form.reset();
        try { delete window[cb]; } catch (e) { window[cb] = undefined; }
        if (s.parentNode) s.parentNode.removeChild(s);
      }
      window[cb] = function (res) {
        if (res && res.result === 'success') {
          finish('Thanks for subscribing — check your inbox to confirm.', true);
        } else {
          var m = (res && res.msg) ? String(res.msg).replace(/<[^>]*>/g, '') : 'Something went wrong. Please try again.';
          if (/already subscribed/i.test(m)) m = 'You are already on the list — thanks!';
          finish(m.replace(/^\d+\s*-\s*/, ''), /already/i.test(m));
        }
      };
      s.src = url;
      s.onerror = function () { finish('Could not reach the server. Please try again.', false); };
      document.body.appendChild(s);
      setTimeout(function () { finish('Could not reach the server. Please try again.', false); }, 12000);
    });
  });
})();

// floating back-to-top
(function(){var b=document.getElementById('aws-totop');if(!b)return;function t(){b.classList.toggle('is-on',window.scrollY>520);}t();window.addEventListener('scroll',t,{passive:true});b.addEventListener('click',function(e){e.preventDefault();window.scrollTo({top:0,behavior:'smooth'});});})();

// ---- hero flowing gradient (WebGL) ----
(function(){
  var box=document.querySelector('.h-aurora'); if(!box) return;
  var cv=box.querySelector('canvas'); if(!cv) return;
  var gl=null; try{ gl=cv.getContext('webgl',{antialias:false,alpha:false,powerPreference:'low-power'})||cv.getContext('experimental-webgl'); }catch(e){}
  if(!gl) return;
  var vs='attribute vec2 a;void main(){gl_Position=vec4(a,0.,1.);}';
  var fs=['precision mediump float;uniform vec2 r;uniform float t;',
  'float h(vec2 p){return fract(sin(dot(p,vec2(127.1,311.7)))*43758.5453);}',
  'float n(vec2 p){vec2 i=floor(p),f=fract(p);f=f*f*(3.-2.*f);return mix(mix(h(i),h(i+vec2(1.,0.)),f.x),mix(h(i+vec2(0.,1.)),h(i+vec2(1.,1.)),f.x),f.y);}',
  'float fbm(vec2 p){float a=.5,s=0.;for(int i=0;i<4;i++){s+=a*n(p);p=p*2.03+vec2(1.7,9.2);a*=.5;}return s;}',
  'void main(){vec2 uv=gl_FragCoord.xy/r;vec2 p=uv;p.x*=r.x/r.y;float tt=t*.045;',
  'vec2 q=vec2(fbm(p*.8+vec2(0.,tt)),fbm(p*.8+vec2(5.2,-tt*1.3)));',
  'vec2 w=p+1.7*q;float f=fbm(w*1.05+vec2(tt*.7,-tt*.4));',
  'float rib=sin(w.x*2.3+f*3.6+tt*2.)*.5+.5;rib=pow(rib,2.1);',
  'vec3 navy=vec3(.055,.055,.047);vec3 indigo=vec3(.36,.06,.02);vec3 violet=vec3(.86,.24,.12);vec3 mag=vec3(1.0,.42,.16);',
  'vec3 c=mix(navy,indigo,smoothstep(.28,.78,f));',
  'c=mix(c,violet,smoothstep(.30,.90,rib*f*1.75));',
  'c=mix(c,mag,smoothstep(.50,1.,rib*q.x*1.95));',
  'float vig=smoothstep(1.2,.2,length((uv-vec2(.5,.60))*vec2(1.05,1.35)));',
  'c=mix(navy*.45,c,vig);gl_FragColor=vec4(c,1.);}'].join('\n');
  function sh(type,src){var s=gl.createShader(type);gl.shaderSource(s,src);gl.compileShader(s);return gl.getShaderParameter(s,gl.COMPILE_STATUS)?s:null;}
  var a=sh(gl.VERTEX_SHADER,vs),b=sh(gl.FRAGMENT_SHADER,fs); if(!a||!b) return;
  var pr=gl.createProgram();gl.attachShader(pr,a);gl.attachShader(pr,b);gl.linkProgram(pr);
  if(!gl.getProgramParameter(pr,gl.LINK_STATUS)) return;
  gl.useProgram(pr);
  var buf=gl.createBuffer();gl.bindBuffer(gl.ARRAY_BUFFER,buf);
  gl.bufferData(gl.ARRAY_BUFFER,new Float32Array([-1,-1,1,-1,-1,1,1,1]),gl.STATIC_DRAW);
  var loc=gl.getAttribLocation(pr,'a');gl.enableVertexAttribArray(loc);gl.vertexAttribPointer(loc,2,gl.FLOAT,false,0,0);
  var uR=gl.getUniformLocation(pr,'r'),uT=gl.getUniformLocation(pr,'t');
  var reduce=window.matchMedia&&window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  function size(){var w=Math.max(2,Math.round(cv.clientWidth*.5)),h=Math.max(2,Math.round(cv.clientHeight*.5));if(cv.width!==w||cv.height!==h){cv.width=w;cv.height=h;gl.viewport(0,0,w,h);}}
  var t0=performance.now(),raf=0,vis=true,last=0;
  function draw(now){size();gl.uniform2f(uR,cv.width,cv.height);gl.uniform1f(uT,40.+(now-t0)/1000.);gl.drawArrays(gl.TRIANGLE_STRIP,0,4);}
  function loop(now){raf=0;if(!vis||document.hidden)return;if(now-last>32){last=now;draw(now);}raf=requestAnimationFrame(loop);}
  function start(){if(!raf&&!reduce)raf=requestAnimationFrame(loop);}
  draw(performance.now());box.classList.add('is-gl');
  if(reduce){window.addEventListener('resize',function(){draw(t0);});return;}
  if('IntersectionObserver' in window){new IntersectionObserver(function(en){vis=en[0].isIntersecting;if(vis)start();}).observe(box);}
  document.addEventListener('visibilitychange',start);
  start();
})();