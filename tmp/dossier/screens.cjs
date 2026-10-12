const {chromium}=require('C:/Users/aureo/.cache/codex-runtimes/codex-primary-runtime/dependencies/node/node_modules/playwright');
const fs=require('fs'),path=require('path');
(async()=>{const browser=await chromium.launch({headless:true,channel:"msedge"}); const page=await browser.newPage();
await page.route('http://dossier.local/**',async route=>{const u=new URL(route.request().url()); let f=u.pathname.startsWith('/build/')||u.pathname.startsWith('/uploads/')?path.join(process.cwd(),'public',decodeURIComponent(u.pathname)):path.join(process.cwd(),'tmp/dossier',u.pathname==='/'?'home.html':u.pathname.slice(1)); if(fs.existsSync(f)&&fs.statSync(f).isFile()){const ext=path.extname(f); await route.fulfill({body:fs.readFileSync(f),contentType:({'.html':'text/html','.css':'text/css','.js':'application/javascript','.png':'image/png','.jpg':'image/jpeg','.woff2':'font/woff2'})[ext]||'application/octet-stream'});}else await route.abort();});
await page.route(/https?:\/\/(?!dossier\.local).*/,route=>route.abort());
for(const [name,width,height,mobile] of [['home',1366,900,false],['gallery',1366,900,false],['quote',1366,1000,false],['home-mobile',390,844,true],['quote-mobile',390,844,true]]){
 await page.setViewportSize({width,height}); await page.goto('http://dossier.local/'+name.replace('-mobile','')+'.html'); await page.screenshot({path:'tmp/dossier/'+name+'.png',fullPage:false}); console.log(name, await page.title());
}
await browser.close();})();

