const {chromium}=require('C:/Users/aureo/.cache/codex-runtimes/codex-primary-runtime/dependencies/node/node_modules/playwright');
const fs=require('fs'),path=require('path');
(async()=>{
 const browser=await chromium.launch({headless:true,channel:'msedge'});
 try{
  for(const mobile of [false,true]){
   const context=await browser.newContext({viewport:mobile?{width:390,height:844}:{width:1366,height:1000},isMobile:mobile,hasTouch:mobile});
   const page=await context.newPage();page.setDefaultTimeout(10000);
   await page.route('**/*',async route=>{
    const u=new URL(route.request().url());if(u.hostname!=='dossier.local')return route.abort();
    const file=u.pathname.startsWith('/build/')||u.pathname.startsWith('/uploads/')?path.join(process.cwd(),'public',decodeURIComponent(u.pathname)):path.join(process.cwd(),'tmp/jury',path.basename(u.pathname));
    if(!fs.existsSync(file)||!fs.statSync(file).isFile())return route.abort();
    const type={'.html':'text/html; charset=utf-8','.css':'text/css','.js':'application/javascript','.png':'image/png','.jpg':'image/jpeg','.jpeg':'image/jpeg','.webp':'image/webp','.woff2':'font/woff2'}[path.extname(file)]||'application/octet-stream';
    await route.fulfill({body:fs.readFileSync(file),contentType:type});
   });
   for(const name of mobile?['home','quote','gallery']:['home','gallery','product','category','quote','login','register','privacy','dashboard','admin-products','admin-quote','admin-quotes','admin-reviews','admin-edit-product']){
    await page.goto('http://dossier.local/'+name+'.html');
    await page.addStyleTag({content:'.sf-toolbar,.sf-toolbar-clearer{display:none!important}'});
    await page.evaluate(()=>document.fonts.ready);
    await page.screenshot({path:'tmp/jury/figures/'+name+(mobile?'-mobile':'')+'.png',fullPage:['quote','admin-edit-product'].includes(name)});
    console.log(name+(mobile?'-mobile':''));
   }
   await context.close();
  }
 }finally{await browser.close();}
})().catch(e=>{console.error(e.message);process.exitCode=1;});
