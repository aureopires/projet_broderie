const fs = require('fs');
const path = require('path');
const sharp = require('C:/Users/aureo/.cache/codex-runtimes/codex-primary-runtime/dependencies/node/node_modules/sharp');
const root = __dirname;
const folders = ['01-brief','02-wireframes-desktop','03-wireframes-mobile','04-maquettes-desktop','05-maquettes-mobile'];
(async()=>{
  for(const folder of folders){
    const dest=path.join(root,'verification',folder);fs.mkdirSync(dest,{recursive:true});
    const files=fs.readdirSync(path.join(root,folder)).filter(x=>x.endsWith('.svg'));
    for(let i=0;i<files.length;i+=2){
      await Promise.all(files.slice(i,i+2).map(async file=>{
        const input=path.join(root,folder,file);const output=path.join(dest,file.replace('.svg','.png'));
        await sharp(input,{limitInputPixels:false}).resize({width:folder==='01-brief'?2200:folder.endsWith('mobile')?390:1440}).png().toFile(output);
      }));
    }
    console.log('Verificado:',folder,files.length);
  }
})().catch(e=>{console.error(e);process.exit(1)});
