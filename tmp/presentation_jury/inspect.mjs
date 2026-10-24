import fs from 'node:fs/promises';
import {PresentationFile,FileBlob} from 'file:///C:/Users/aureo/.cache/codex-runtimes/codex-primary-runtime/dependencies/node/node_modules/@oai/artifact-tool/dist/artifact_tool.mjs';
const p=await PresentationFile.importPptx(await FileBlob.load('output/Aureo_Ruffier_Presentation_Projet.pptx'));
for(let i=0;i<p.slides.items.length;i++){const s=p.slides.items[i];try{await fs.writeFile(`tmp/presentation_jury/source-${i+1}.png`,new Uint8Array(await (await p.export({slide:s,format:'png',scale:0.7})).arrayBuffer()));}catch(e){console.log(i+1,e.message)}}
console.log('rendered',p.slides.items.length);
